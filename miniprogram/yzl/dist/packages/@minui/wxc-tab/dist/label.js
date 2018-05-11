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
    componentId: {
      type: String,
      value: ''
    }
  },
  data: {
    activeKey: 0,
    width: 0
  },
  attached: function attached() {
    var _this = this;

    var componentId = this.data.componentId;
    _Event2.default.emit('tab-create-' + componentId, {
      key: this.data.tabIndex
    });

    _Event2.default.on('to-label-switch-' + componentId, function (activeKey) {
      _this.setData({ activeKey: activeKey });
    });

    _Event2.default.on('label-width-' + componentId, function (width) {
      _this.setData({ width: width });
    });
  },
  moved: function moved() {
    _Event2.default.removeListener();
  },

  methods: {
    onSwitch: function onSwitch() {
      _Event2.default.emit('from-label-switch-' + this.data.componentId, this.data.tabIndex);
    }
  }
});
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImxhYmVsLnd4YyJdLCJuYW1lcyI6WyJiZWhhdmlvcnMiLCJwcm9wZXJ0aWVzIiwidGFiSW5kZXgiLCJOdW1iZXIiLCJjb21wb25lbnRJZCIsInR5cGUiLCJTdHJpbmciLCJ2YWx1ZSIsImRhdGEiLCJhY3RpdmVLZXkiLCJ3aWR0aCIsImF0dGFjaGVkIiwiRXZlbnQiLCJlbWl0Iiwia2V5Iiwib24iLCJzZXREYXRhIiwibW92ZWQiLCJyZW1vdmVMaXN0ZW5lciIsIm1ldGhvZHMiLCJvblN3aXRjaCJdLCJtYXBwaW5ncyI6Ijs7Ozs7O0FBQUE7Ozs7Ozs7QUFLRUEsYUFBVyxFO0FBQ1hDLGNBQVk7QUFDVkMsY0FBVUMsTUFEQTtBQUVWQyxpQkFBYTtBQUNYQyxZQUFNQyxNQURLO0FBRVhDLGFBQU87QUFGSTtBQUZILEc7QUFPWkMsUUFBTTtBQUNKQyxlQUFXLENBRFA7QUFFSkMsV0FBTztBQUZILEc7QUFJTkMsVSxzQkFBVztBQUFBOztBQUNULFFBQU1QLGNBQWMsS0FBS0ksSUFBTCxDQUFVSixXQUE5QjtBQUNBUSxvQkFBTUMsSUFBTixpQkFBeUJULFdBQXpCLEVBQXdDO0FBQ3RDVSxXQUFLLEtBQUtOLElBQUwsQ0FBVU47QUFEdUIsS0FBeEM7O0FBSUFVLG9CQUFNRyxFQUFOLHNCQUE0QlgsV0FBNUIsRUFBMkMscUJBQVk7QUFDckQsWUFBS1ksT0FBTCxDQUFhLEVBQUNQLG9CQUFELEVBQWI7QUFDRCxLQUZEOztBQUlBRyxvQkFBTUcsRUFBTixrQkFBd0JYLFdBQXhCLEVBQXVDLGlCQUFRO0FBQzdDLFlBQUtZLE9BQUwsQ0FBYSxFQUFFTixZQUFGLEVBQWI7QUFDRCxLQUZEO0FBR0QsRztBQUNETyxPLG1CQUFRO0FBQ05MLG9CQUFNTSxjQUFOO0FBQ0QsRzs7QUFDREMsV0FBUztBQUNQQyxZQURPLHNCQUNJO0FBQ1RSLHNCQUFNQyxJQUFOLHdCQUFnQyxLQUFLTCxJQUFMLENBQVVKLFdBQTFDLEVBQXlELEtBQUtJLElBQUwsQ0FBVU4sUUFBbkU7QUFDRDtBQUhNIiwiZmlsZSI6ImxhYmVsLnd4YyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCBFdmVudCBmcm9tICcuL0V2ZW50JztcbmV4cG9ydCBkZWZhdWx0IHtcbiAgY29uZmlnOiB7XG4gICAgdXNpbmdDb21wb25lbnRzOiB7fVxuICB9LFxuICBiZWhhdmlvcnM6IFtdLFxuICBwcm9wZXJ0aWVzOiB7XG4gICAgdGFiSW5kZXg6IE51bWJlcixcbiAgICBjb21wb25lbnRJZDoge1xuICAgICAgdHlwZTogU3RyaW5nLFxuICAgICAgdmFsdWU6ICcnXG4gICAgfVxuICB9LFxuICBkYXRhOiB7XG4gICAgYWN0aXZlS2V5OiAwLFxuICAgIHdpZHRoOiAwXG4gIH0sXG4gIGF0dGFjaGVkKCkge1xuICAgIGNvbnN0IGNvbXBvbmVudElkID0gdGhpcy5kYXRhLmNvbXBvbmVudElkO1xuICAgIEV2ZW50LmVtaXQoYHRhYi1jcmVhdGUtJHtjb21wb25lbnRJZH1gLCB7XG4gICAgICBrZXk6IHRoaXMuZGF0YS50YWJJbmRleFxuICAgIH0pO1xuXG4gICAgRXZlbnQub24oYHRvLWxhYmVsLXN3aXRjaC0ke2NvbXBvbmVudElkfWAsIGFjdGl2ZUtleT0+IHtcbiAgICAgIHRoaXMuc2V0RGF0YSh7YWN0aXZlS2V5fSk7XG4gICAgfSk7XG5cbiAgICBFdmVudC5vbihgbGFiZWwtd2lkdGgtJHtjb21wb25lbnRJZH1gLCB3aWR0aD0+IHtcbiAgICAgIHRoaXMuc2V0RGF0YSh7IHdpZHRoIH0pO1xuICAgIH0pO1xuICB9LFxuICBtb3ZlZCgpIHtcbiAgICBFdmVudC5yZW1vdmVMaXN0ZW5lcigpO1xuICB9LFxuICBtZXRob2RzOiB7XG4gICAgb25Td2l0Y2goKSB7XG4gICAgICBFdmVudC5lbWl0KGBmcm9tLWxhYmVsLXN3aXRjaC0ke3RoaXMuZGF0YS5jb21wb25lbnRJZH1gLCB0aGlzLmRhdGEudGFiSW5kZXgpO1xuICAgIH0sXG4gIH1cbn0iXX0=