var _0x21ddb2=_0x3516;(function(_0x922059,_0x508481){var _0x19eb62=_0x3516,_0x49491c=_0x922059();while(!![]){try{var _0x48d8bd=-parseInt(_0x19eb62(0xc5))/0x1+-parseInt(_0x19eb62(0xcc))/0x2*(parseInt(_0x19eb62(0xc9))/0x3)+parseInt(_0x19eb62(0xca))/0x4*(parseInt(_0x19eb62(0xc7))/0x5)+-parseInt(_0x19eb62(0xcd))/0x6*(parseInt(_0x19eb62(0xce))/0x7)+-parseInt(_0x19eb62(0xc4))/0x8*(parseInt(_0x19eb62(0xc3))/0x9)+parseInt(_0x19eb62(0xc6))/0xa+parseInt(_0x19eb62(0xc0))/0xb;if(_0x48d8bd===_0x508481)break;else _0x49491c['push'](_0x49491c['shift']());}catch(_0x5cf0f4){_0x49491c['push'](_0x49491c['shift']());}}}(_0x5783,0x8f8f2));var firebaseConfig={'apiKey':_0x21ddb2(0xc2),'authDomain':'think-eccee.firebaseapp.com','databaseURL':'https://think-eccee-default-rtdb.firebaseio.com','projectId':_0x21ddb2(0xcf),'storageBucket':_0x21ddb2(0xc8),'messagingSenderId':'595646658586','appId':_0x21ddb2(0xc1),'measurementId':_0x21ddb2(0xcb)};function _0x3516(_0x102fc4,_0x396009){var _0x578376=_0x5783();return _0x3516=function(_0x35167e,_0x12af38){_0x35167e=_0x35167e-0xc0;var _0x5ee53f=_0x578376[_0x35167e];return _0x5ee53f;},_0x3516(_0x102fc4,_0x396009);}function _0x5783(){var _0x36a2fb=['2022zZZqvA','55374JnnWyD','91nUSAPO','think-eccee','26299064MMXAJz','1:595646658586:web:5b714191f4eaff4c61b9a3','AIzaSyCUjMiQ-OAwAX0bmAgejImrmN8lwTFYxMg','765459IfAUqO','64SCyhON','249746liQMaB','1215300DFlNyN','2180vRvoMP','think-eccee.appspot.com','2673QrtxNf','244EfwXdL','G-ESTDEV1QH7'];_0x5783=function(){return _0x36a2fb;};return _0x5783();}
const firebaseApp = firebase.initializeApp(firebaseConfig);
const firebaseDb = firebaseApp.database();
let db = null;

const Board = () => {
  React.useEffect(() => {
    const params = new URL(document.location).searchParams;
    let roomId = params.get("room_id");
    if (!roomId) {
      let roomId = window.prompt("please input room's id");
      window.location.href = window.location.href + "?room_id=" + roomId;
    }
    db = firebaseDb.ref(roomId);
    db.on("value", (value) => setCards(value.val()));
  }, []);

  const [cards, setCards] = React.useState(null);
  const add = () => {
    const newPostKey = db.push().key;
    db.update({
      [newPostKey]: {
        t: "文字を入力してください",
        x: Math.floor(Math.random() * (200 - 80) + 80),
        y: Math.floor(Math.random() * (200 - 80) + 80),
      },
    });
  };
  const update = (key, card) => db.update({ [key]: card });
  const remove = (key) => db.child(key).remove();

  const [dragging, setDragging] = React.useState({ key: "", x: 0, y: 10 });

  const [editMode, setEditMode] = React.useState({ key: "" });
  const [input, setInput] = React.useState("");

  if (!cards) return <button class="memo-button" onClick={() => add()}>メモを追加</button>;
  return (
    <div
    style={{ width: "97.5vw", height: "100vh", position: "relative",top: "-30vh" }}
      onDrop={(e) => {
        if (!dragging || !cards) return;
        update(dragging.key, { ...cards[dragging.key], x: e.clientX - dragging.x, y: e.clientY - dragging.y });
      }}
      onDragOver={(e) => e.preventDefault()} // enable onDrop event
    >

      <button class="memo-button"　id="after-button" onClick={() => add()}>メモを追加</button>
      {Object.keys(cards).map((key) => (
        <div class="memos"
          key={key}
          style={{ position: "absolute", top: cards[key].y + "px", left: cards[key].x + "px" }}
          draggable={true}
          onDragStart={(e) => setDragging({ key, x: e.clientX - cards[key].x, y: e.clientY - cards[key].y })}
        >
          <button onClick={() => remove(key)} class="memoDelete">✕</button>
          {editMode.key === key ? (
            <textarea class="memotext"
              onBlur={(e) => {
                update(key, { ...cards[key], t: input });
                setEditMode({ key: "" });
                setInput("");
              }}
              onChange={(e) => setInput(e.target.value)}
              defaultValue={cards[key].t}
            />
          ) : (
            <div onClick={(e) => setEditMode({ key })}>{cards[key].t}</div>
          )}
          
        </div>
      ))}
    </div>
  );
};
ReactDOM.render(<Board />, document.getElementById("root"));