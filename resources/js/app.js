//resources/js/app.js
import '../css/app.css';
import './bootstrap.js';
import $ from 'jquery';


$(document).ready(function () {

    const app = {
        currentColor: 'red', // Текущий активный цвет светофора
        colorSequence: ['red', 'yellow', 'green', 'yellow'], // Последовательность смены цветов
        colorIndex: 0, // Индекс текущего цвета в последовательности
        colorDurations: {'red': 5000, 'yellow': 2000, 'green': 5000}, // Длительности цветов
        previousColor: '', // Для отслеживания предыдущего цвета

        /**
         * Инициализация приложения: установка начального цвета и запуск цикла смены светофора.
         */

        init: function () {
            this.changeLight(this.currentColor); // Устанавливаем начальный цвет
            this.startTrafficLight(); // Запускаем цикл смены цветов
            this.bindEvents(); // Привязываем события к кнопкам
        },

        /**
         * Привязка событий к элементам страницы.
         */

        bindEvents: function () {
            $('#forward-button').click(() => {
                this.logTraffic(); // Выполняем отправку запроса асинхронно
            });
        },


        /**
         * Запуск цикла смены цветов светофора.
         */

        startTrafficLight: function () {
            this.cycleColors(); // Запускаем смену цветов
        },

        /**
         * Переключение на следующий цвет в цикле.
         */

        cycleColors: function () {
            const duration = this.getCurrentDuration();
            setTimeout(() => {
                this.previousColor = this.currentColor;
                this.colorIndex = (this.colorIndex + 1) % this.colorSequence.length;
                this.currentColor = this.colorSequence[this.colorIndex];
                this.changeLight(this.currentColor);
                this.cycleColors();
            }, duration);
        },

        /**
         * Получение текущей длительности активного цвета.
         */

        getCurrentDuration: function () {
            return this.colorDurations[this.currentColor];
        },

        /**
         * Изменение активного цвета светофора.
         */

        changeLight: function (color) {
            $('.light').removeClass('active'); // Снимаем подсветку со всех цветов
            $('#' + color).addClass('active'); // Подсвечиваем текущий цвет
        },


        /**
         * Логирование действия и отправка его на сервер.
         */

        logTraffic: function () {
            const action = this.currentColor;
            const previousAction = this.previousColor;
            $.ajax({
                url: '/log',
                method: 'POST',
                data: {
                    action: action,
                    previousAction: previousAction,
                    _token: $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {
                if (response) {
                    this.updateLogTable(response);
                } else {
                    console.error('Ошибка при записи в лог');
                }
            }).catch(error => {
                console.error('Ошибка при выполнении запроса:', error);
            });
        },

        updateLogTable: function (message) {
            const newRow = `<tr><td>${message}</td><td>${new Date().toLocaleTimeString()}</td></tr>`;
            $('#log-table tbody').prepend(newRow);
        },
    };

    app.init();
});
