var canvas = document.getElementById('whiteboard');
var context = canvas.getContext('2d');
var drawingHistory = [];
var redoHistory = [];
var isDrawing = false;
var lastX = 0;
var lastY = 0;
var eraserEnabled = false;
var eraserCheckbox = document.getElementById('eraser-checkbox');
var colorPicker = document.getElementById('color-picker');
var clearButton = document.getElementById('clear-button');

eraserCheckbox.addEventListener('change', function() {
  eraserEnabled = eraserCheckbox.checked;
});

colorPicker.addEventListener('change', function() {
  updateColor();
});

clearButton.addEventListener('click', function() {
  showConfirmationDialog();
  if (eraserEnabled) {
    context.lineWidth = 2; // デフォルトのブラシサイズにリセット
    eraserCheckbox.checked = false; // 消しゴムモードを解除
  }
});

function updateColor() {
  context.strokeStyle = colorPicker.value;
}

function showConfirmationDialog() {
  if (confirm('キャンバスを全消去します。よろしいですか？')) {
    clearCanvas();
  }
}

function clearCanvas() {
  context.clearRect(0, 0, canvas.width, canvas.height);
  drawingHistory = [];
  redoHistory = [];
  context.lineWidth = 2; // デフォルトのブラシサイズにリセット
  context.strokeStyle = colorPicker.value; // 選択された色にリセット
}

canvas.addEventListener('mousedown', function(e) {
  isDrawing = true;
  lastX = e.offsetX;
  lastY = e.offsetY;
});

canvas.addEventListener('mousemove', function(e) {
  if (!isDrawing) return;

  if (!eraserEnabled) {
    context.beginPath();
    context.moveTo(lastX, lastY);
    context.lineTo(e.offsetX, e.offsetY);
    context.stroke();
  } else {
    context.strokeStyle = '#EFEFEF';
    context.lineWidth = 10;
    context.beginPath();
    context.moveTo(lastX, lastY);
    context.lineTo(e.offsetX, e.offsetY);
    context.stroke();
  }

  if (!eraserEnabled) {
    drawingHistory.push({
      startX: lastX,
      startY: lastY,
      endX: e.offsetX,
      endY: e.offsetY,
      eraser: false,
      color: context.strokeStyle
    });
  } else {
    drawingHistory.push({
      startX: lastX,
      startY: lastY,
      endX: e.offsetX,
      endY: e.offsetY,
      eraser: true
    });
  }

  redoHistory = [];

  lastX = e.offsetX;
  lastY = e.offsetY;

  // データをサーバーに送信する
  sendDrawingData();
});

canvas.addEventListener('mouseup', function() {
  isDrawing = false;
});

canvas.addEventListener('mouseout', function() {
  isDrawing = false;
});

function undoLastDrawing() {
  if (drawingHistory.length > 0) {
    var lastDrawing = drawingHistory.pop();

    context.clearRect(0, 0, canvas.width, canvas.height);

    for (var i = 0; i < drawingHistory.length; i++) {
      var drawing = drawingHistory[i];
      if (!drawing.eraser) {
        context.strokeStyle = drawing.color;
        context.beginPath();
        context.moveTo(drawing.startX, drawing.startY);
        context.lineTo(drawing.endX, drawing.endY);
        context.stroke();
      } else {
        context.strokeStyle = '#FFFFFF';
        context.lineWidth = 10;
        context.beginPath();
        context.moveTo(drawing.startX, drawing.startY);
        context.lineTo(drawing.endX, drawing.endY);
        context.stroke();
      }
    }

    redoHistory.push(lastDrawing);

    // データをサーバーに送信する
    sendDrawingData();
  }
}

function redoLastDrawing() {
  if (redoHistory.length > 0) {
    var lastRedoDrawing = redoHistory.pop();

    if (!lastRedoDrawing.eraser) {
      context.strokeStyle = lastRedoDrawing.color;
      context.beginPath();
      context.moveTo(lastRedoDrawing.startX, lastRedoDrawing.startY);
      context.lineTo(lastRedoDrawing.endX, lastRedoDrawing.endY);
      context.stroke();
    } else {
      context.strokeStyle = '#FFFFFF';
      context.lineWidth = 10;
      context.beginPath();
      context.moveTo(lastRedoDrawing.startX, lastRedoDrawing.startY);
      context.lineTo(lastRedoDrawing.endX, lastRedoDrawing.endY);
      context.stroke();
    }

    drawingHistory.push(lastRedoDrawing);

    // データをサーバーに送信する
    sendDrawingData();
  }
}

var eraserCheckbox = document.getElementById('eraser-checkbox');

document.getElementById('clear-button').addEventListener('click', function() {
  var context = whiteboard.getContext('2d');
  context.clearRect(0, 0, whiteboard.width, whiteboard.height);
  if (eraserCheckbox.checked) {
    eraserCheckbox.checked = false;
  }

  // データをサーバーに送信する
  sendDrawingData();
});

// データをサーバーに送信する
function sendDrawingData() {
  var data = {
    drawingHistory: drawingHistory,
    redoHistory: redoHistory
  };

  // Ajaxリクエストを送信する
  $.ajax({
    url: 'server-script.php', // サーバーサイドスクリプトのパスを指定
    type: 'POST', // リクエストメソッドを指定（POSTメソッドを想定）
    data: { data: JSON.stringify(data) }, // 送信するデータをオブジェクトとして指定
    dataType: 'json', // レスポンスのデータタイプを指定（JSONを想定）
    success: function(response) {
      // リクエストが成功した場合の処理
      console.log(response);
      // 応答データを使った追加の処理をここに記述
    },
    error: function(xhr, status, error) {
      // リクエストがエラーとなった場合の処理
      console.error(error);
    }
  });
}

// 定期的にサーバーからデータを取得するポーリング処理
function pollDrawingData() {
  setInterval(function() {
    // Ajaxリクエストを送信する
    $.ajax({
      url: './server-script.php', // サーバーサイドスクリプトのパスを指定
      type: 'GET', // リクエストメソッドを指定（GETメソッドを想定）
      dataType: 'json', // レスポンスのデータタイプを指定（JSONを想定）
      success: function(response) {
        // リクエストが成功した場合の処理
        console.log(response);

        // 受信したデータをホワイトボードに反映する
        if (response && response.data) {
          var receivedData = JSON.parse(response.data);

          // drawingHistoryとredoHistoryを更新する
          drawingHistory = receivedData.drawingHistory;
          redoHistory = receivedData.redoHistory;

          // ホワイトボード上にデータを描画する
          redrawCanvas();
        }
      },
      error: function(xhr, status, error) {
        // リクエストがエラーとなった場合の処理
        console.error(error);
      }
    });
  }, 1000); // 1秒ごとにポーリングする（適宜調整してください）
}

// ホワイトボード上にデータを描画する
function redrawCanvas() {
  // キャンバスをクリアする
  context.clearRect(0, 0, canvas.width, canvas.height);

  // drawingHistoryをもとに描画を再現する
  for (var i = 0; i < drawingHistory.length; i++) {
    var drawing = drawingHistory[i];
    if (!drawing.eraser) {
      context.strokeStyle = drawing.color;
      context.beginPath();
      context.moveTo(drawing.startX, drawing.startY);
      context.lineTo(drawing.endX, drawing.endY);
      context.stroke();
    } else {
      context.strokeStyle = '#FFFFFF';
      context.lineWidth = 10;
      context.beginPath();
      context.moveTo(drawing.startX, drawing.startY);
      context.lineTo(drawing.endX, drawing.endY);
      context.stroke();
    }
  }
}

// ポーリング処理を開始する
pollDrawingData();
