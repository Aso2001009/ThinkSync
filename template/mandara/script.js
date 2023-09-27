function mdclick(){
    //トグルボタンの状態を取得
    var state = document.getElementById("toggle").checked;
    //状態を表示
    if(state == true){
        document.getElementById('table-container').style.display = "block";
    }else{
        document.getElementById('table-container').style.display = "none";
    }
}

 // 9x9の表を生成する関数
function createTable(rows, cols) {
    const tableContainer = document.getElementById('table-container');
    const table = document.createElement('table');

    for (let i = 0; i < rows; i++) {
      const row = document.createElement('tr');
      for (let j = 0; j < cols; j++) {
        const cell = document.createElement('td');
        row.appendChild(cell);
      }
      table.appendChild(row);
    }

    tableContainer.appendChild(table);
}