document.addEventListener('DOMContentLoaded', function() {
    var timerElement = document.getElementById('timer');
    var settingsButton = document.getElementById('settings-button');
    var settingsPopup = document.getElementById('settings-popup');
    var minutesSpan = document.getElementById('minutes');
    var secondsSpan = document.getElementById('seconds');
    var clearButton = document.getElementById('clear-button');
    var timerInterval;

    settingsButton.addEventListener('click', function() {
        settingsPopup.style.display = 'block';
    });

    document.addEventListener('click', function(event) {
        if (event.target !== settingsButton && !settingsPopup.contains(event.target)) {
            settingsPopup.style.display = 'none';
        }
    });

    document.getElementById('timer-form').addEventListener('submit', function(event) {
        event.preventDefault();

        var minutesInput = document.getElementById('minutes-input');
        var secondsInput = document.getElementById('seconds-input');

        var minutes = parseInt(minutesInput.value);
        var seconds = parseInt(secondsInput.value);

        if (isNaN(minutes) || isNaN(seconds)) {
            alert('分、秒は数値で入力してください。');
            return;
        }

        var totalSeconds = minutes * 60 + seconds;

        updateTimerDisplay(totalSeconds);

        if (timerInterval) {
            clearInterval(timerInterval);
        }

        timerInterval = setInterval(function() {
            totalSeconds--;

            if (totalSeconds <= 0) {
                clearInterval(timerInterval);
                alert('タイマーが終了しました。');
                updateTimerDisplay(0);
            } else {
                updateTimerDisplay(totalSeconds);
            }
        }, 1000);

        settingsPopup.style.display = 'none';
    });

    clearButton.addEventListener('click', function() {
        clearInterval(timerInterval);
        updateTimerDisplay(0);
    });

    function updateTimerDisplay(totalSeconds) {
        var minutes = Math.floor(totalSeconds / 60);
        var seconds = totalSeconds % 60;

        minutesSpan.textContent = formatTime(minutes);
        secondsSpan.textContent = formatTime(seconds);
    }

    function formatTime(time) {
        return time < 10 ? '0' + time : time;
    }
});