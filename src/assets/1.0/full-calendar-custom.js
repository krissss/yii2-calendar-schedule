;(function ($, undefined) {
  "use strict";
  var _global;

  function KrissCalendar(opt) {
    this._initial(opt);
    this._init();
  }

  KrissCalendar.prototype = {
    constructor: this,
    _initial: function (opt) {
      var def = {
        draggableEventTemplate: '<div class="draggable-event" style="background-color: {color} !important">{name}</div>',
        draggableEventContainer: '#draggable-event-container',
        draggableEvent: '.draggable-event',
        draggableEventAfterRemove: '#drop-remove',
        draggableEventDropToCash: '#drop-to-cash',
        draggableEventRemoveCallback: null,
        createEventChooseColor: '#color-chooser-container .color-chooser',
        createEventAddNewEvent: '#add-new-event',
        createEventNewEventInput: '#new-event-input',
        createEventAddNewEventCallback: null,
        fullCalendar: '#full-calendar',
        defaultEventDuration: "02:00", // 默认事件的时间间隔
        calendarEventStick: true, // 日程的时间是否固定
      };
      var options = $.extend(def, opt);
      var _this = this;
      options.fullCalendarOptions = $.extend(options.fullCalendarOptions, {
        editable: true,
        droppable: true,
        dropAccept: options.draggableEventContainer + ' ' + options.draggableEvent,
        drop: function (date, jsEvent, ui, resourceId) {
          if ($(options.draggableEventAfterRemove).is(':checked')) {
            _this._removeUiDropItem($(this));
          }
          // drop 的额外操作
          options.fullCalendarOptions.dropCallback && options.fullCalendarOptions.dropCallback(date, jsEvent, ui, resourceId);
        }
      });
      this.options = options;
    },
    _init: function () {
      var options = this.options,
        _this = this;
      // 初始化可移动的区域
      _this._initDraggableEvents($(options.draggableEventContainer + ' ' + options.draggableEvent));
      // 事件删除组件
      $(options.draggableEventDropToCash).droppable({
        accept: options.draggableEventContainer + ' ' + options.draggableEvent,
        classes: {
          "ui-droppable-active": "alert-warning"
        },
        drop: function (event, ui) {
          _this._removeUiDropItem(ui.draggable);
        }
      });
      // 选择颜色事件
      $(options.createEventChooseColor).click(function (e) {
        e.preventDefault();
        _this._addColorStyle($(options.createEventAddNewEvent), $(this).css('backgroundColor'));
      });
      // 点击增加按钮
      $(options.createEventAddNewEvent).click(function (e) {
        e.preventDefault();
        var val = $(options.createEventNewEventInput).val();
        if (val.length === 0) {
          return;
        }
        var color = $(this).css('backgroundColor');
        var event = options.draggableEventTemplate.replace(/{name}/g, val).replace(/{color}/g, color);
        event = $(event);
        $(options.draggableEventContainer).prepend(event);
        _this._initDraggableEvents(event);
        $(options.createEventNewEventInput).val('');

        // 新增事件后的回调
        options.createEventAddNewEventCallback && options.createEventAddNewEventCallback(val, color);
      });
      // 日历组件
      $(options.fullCalendar).fullCalendar(options.fullCalendarOptions);
    },
    // 初始化可拖动的事件
    _initDraggableEvents: function (el) {
      var options = this.options;
      el.each(function () {
        $(this).data('event', {
          title: $.trim($(this).text()),
          stick: options.calendarEventStick,
          color: $(this).css('backgroundColor'),
          duration: options.defaultEventDuration
        });
        $(this).draggable({
          zIndex: 1070,
          revert: true,
          revertDuration: 0
        });
      });
    },
    // 删除 jquery UI 的事件
    _removeUiDropItem: function (item) {
      var options = this.options;
      item.draggable('destroy');
      item.hide(); // 使用 item.remove() 会导致 full-calendar 下一次 drop 使用已被删除的数据，所以使用 hide() 代替
      // 移除事件后的回调
      options.draggableEventRemoveCallback && options.draggableEventRemoveCallback(item.text(), item.attr('data-color'));
    },
    // 增加颜色的样式
    _addColorStyle: function (el, color) {
      el.css('cssText', 'background-color:' + color + ' !important');
    },

    // 获取 full-calendar
    getFullCalendar: function () {
      return $(this.options.fullCalendar);
    }
  };


  _global = (function () {
    return this || (0, eval)('this');
  }());
  if (typeof module !== "undefined" && module.exports) {
    module.exports = KrissCalendar;
  } else if (typeof define === "function" && define.amd) {
    define(function () {
      return KrissCalendar;
    });
  } else {
    !('KrissCalendar' in _global) && (_global.KrissCalendar = KrissCalendar);
  }
})(jQuery);
