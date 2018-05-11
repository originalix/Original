'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _Event = require('./Event.js');

var _Event2 = _interopRequireDefault(_Event);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = Component({
  behaviors: [],
  properties: {
    tabIndex: Number,
    label: String,
    componentId: {
      type: String,
      value: ''
    }
  },
  data: {
    activeKey: 1,
    test: 0
  },
  attached: function attached() {
    var _this = this;

    this.componentId = this.data.componentId;
    this.data.label && _Event2.default.emit('tab-create-' + this.componentId, {
      key: this.data.tabIndex,
      label: this.data.label
    });
    _Event2.default.on('to-panel-switch-' + this.componentId, function (activeKey) {
      _this.setData({ activeKey: activeKey });
    });
  },

  methods: {}
});
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInBhbmVsLnd4YyJdLCJuYW1lcyI6WyJiZWhhdmlvcnMiLCJwcm9wZXJ0aWVzIiwidGFiSW5kZXgiLCJOdW1iZXIiLCJsYWJlbCIsIlN0cmluZyIsImNvbXBvbmVudElkIiwidHlwZSIsInZhbHVlIiwiZGF0YSIsImFjdGl2ZUtleSIsInRlc3QiLCJhdHRhY2hlZCIsIkV2ZW50IiwiZW1pdCIsImtleSIsIm9uIiwic2V0RGF0YSIsIm1ldGhvZHMiXSwibWFwcGluZ3MiOiI7Ozs7OztBQUFBOzs7Ozs7O0FBS0VBLGFBQVcsRTtBQUNYQyxjQUFZO0FBQ1ZDLGNBQVVDLE1BREE7QUFFVkMsV0FBT0MsTUFGRztBQUdWQyxpQkFBYTtBQUNYQyxZQUFNRixNQURLO0FBRVhHLGFBQU87QUFGSTtBQUhILEc7QUFRWkMsUUFBTTtBQUNKQyxlQUFXLENBRFA7QUFFSkMsVUFBTTtBQUZGLEc7QUFJTkMsVSxzQkFBVztBQUFBOztBQUNULFNBQUtOLFdBQUwsR0FBbUIsS0FBS0csSUFBTCxDQUFVSCxXQUE3QjtBQUNBLFNBQUtHLElBQUwsQ0FBVUwsS0FBVixJQUFtQlMsZ0JBQU1DLElBQU4saUJBQXlCLEtBQUtSLFdBQTlCLEVBQTZDO0FBQzlEUyxXQUFLLEtBQUtOLElBQUwsQ0FBVVAsUUFEK0M7QUFFOURFLGFBQU8sS0FBS0ssSUFBTCxDQUFVTDtBQUY2QyxLQUE3QyxDQUFuQjtBQUlBUyxvQkFBTUcsRUFBTixzQkFBNEIsS0FBS1YsV0FBakMsRUFBZ0QscUJBQWE7QUFDM0QsWUFBS1csT0FBTCxDQUFhLEVBQUVQLG9CQUFGLEVBQWI7QUFDRCxLQUZEO0FBR0QsRzs7QUFDRFEsV0FBUyIsImZpbGUiOiJwYW5lbC53eGMiLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgRXZlbnQgZnJvbSAnLi9FdmVudCc7XG5leHBvcnQgZGVmYXVsdCB7XG4gIGNvbmZpZzoge1xuICAgIHVzaW5nQ29tcG9uZW50czoge31cbiAgfSxcbiAgYmVoYXZpb3JzOiBbXSxcbiAgcHJvcGVydGllczoge1xuICAgIHRhYkluZGV4OiBOdW1iZXIsXG4gICAgbGFiZWw6IFN0cmluZyxcbiAgICBjb21wb25lbnRJZDoge1xuICAgICAgdHlwZTogU3RyaW5nLFxuICAgICAgdmFsdWU6ICcnXG4gICAgfVxuICB9LFxuICBkYXRhOiB7XG4gICAgYWN0aXZlS2V5OiAxLFxuICAgIHRlc3Q6IDBcbiAgfSxcbiAgYXR0YWNoZWQoKSB7XG4gICAgdGhpcy5jb21wb25lbnRJZCA9IHRoaXMuZGF0YS5jb21wb25lbnRJZDtcbiAgICB0aGlzLmRhdGEubGFiZWwgJiYgRXZlbnQuZW1pdChgdGFiLWNyZWF0ZS0ke3RoaXMuY29tcG9uZW50SWR9YCwge1xuICAgICAga2V5OiB0aGlzLmRhdGEudGFiSW5kZXgsXG4gICAgICBsYWJlbDogdGhpcy5kYXRhLmxhYmVsXG4gICAgfSk7XG4gICAgRXZlbnQub24oYHRvLXBhbmVsLXN3aXRjaC0ke3RoaXMuY29tcG9uZW50SWR9YCwgYWN0aXZlS2V5ID0+IHtcbiAgICAgIHRoaXMuc2V0RGF0YSh7IGFjdGl2ZUtleSB9KTtcbiAgICB9KTtcbiAgfSxcbiAgbWV0aG9kczoge31cbn0iXX0=