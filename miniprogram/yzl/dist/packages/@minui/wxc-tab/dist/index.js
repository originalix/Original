'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _Event = require('./Event.js');

var _Event2 = _interopRequireDefault(_Event);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = Component({
  options: {
    multipleSlots: true // support multi slot
  },
  behaviors: [],
  properties: {
    fullScreen: {
      type: Boolean,
      value: false
    },
    defaultIndex: {
      type: Number,
      value: 0
    },
    componentId: {
      type: String,
      value: ''
    },
    animate: {
      type: Boolean,
      value: false
    },
    textColor: {
      type: String,
      value: '#000'
    },
    activeTextColor: {
      type: String,
      value: '#ff5777'
    },
    lineColor: {
      type: String,
      value: '#ddd'
    },
    activeLineColor: {
      type: String,
      value: '#ff5777'
    }
  },
  data: {
    tabs: [],
    width: 0,
    activeKey: 0,
    move: 0
  },
  attached: function attached() {
    var _this = this;

    this.componentId = this.data.componentId;
    this.tabs = [];
    _Event2.default.on('tab-create-' + this.componentId, function (tab) {
      _this.type = !tab.label ? 'complex' : 'simple';
      _this.tabs.push(tab);
    });
  },
  ready: function ready() {
    var activeKey = this.minAndMax(this.data.defaultIndex);
    this.onSwitch(activeKey, 'all');
    this.listenSwitch();
    // const width = this.tabs.length < 5 ? (100 / this.tabs.length) : 25;
    var len = this.tabs.length;
    var width = parseInt(750 / (len > 5 ? 5 : len));
    this.type === 'complex' && _Event2.default.emit('label-width-' + this.componentId, width);
    this.setData({
      tabs: this.tabs,
      width: width,
      type: this.type,
      move: width * activeKey
    });
  },
  detached: function detached() {
    _Event2.default.removeListener();
  },

  methods: {

    // limit input range
    minAndMax: function minAndMax(activeKey) {
      var max = this.tabs.length - 1;
      var min = 0;
      if (activeKey > max) {
        return max;
      } else if (activeKey < min) {
        return 0;
      } else {
        return activeKey;
      }
    },


    // lisen child component tab event
    listenSwitch: function listenSwitch() {
      var _this2 = this;

      _Event2.default.on('from-label-switch-' + this.componentId, function (key) {
        _this2.onSwitch(key, 'to-panel');
      });
      _Event2.default.on('from-panel-switch-' + this.componentId, function (key) {
        _this2.onSwitch(key, 'to-label');
      });
    },
    onSwitch: function onSwitch(activeKey, toNotice) {
      if (!toNotice) {
        activeKey = activeKey.currentTarget.dataset.idx;
        toNotice = 'to-panel';
      }
      var move = activeKey * this.data.width;
      this.setData({
        activeKey: activeKey,
        move: move
      });

      // to notice panel and label tab has switched
      if (toNotice === 'all') {
        _Event2.default.emit('to-label-switch-' + this.componentId, activeKey);
        _Event2.default.emit('to-panel-switch-' + this.componentId, activeKey);
      } else {
        _Event2.default.emit(toNotice + '-switch-' + this.componentId, activeKey);
      }

      this.afterSwitch(activeKey);
    },
    afterSwitch: function afterSwitch(activeKey) {
      this.triggerEvent('tabchange', {
        key: activeKey,
        componentId: this.componentId
      });
    }
  }
});
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImluZGV4Lnd4YyJdLCJuYW1lcyI6WyJvcHRpb25zIiwibXVsdGlwbGVTbG90cyIsImJlaGF2aW9ycyIsInByb3BlcnRpZXMiLCJmdWxsU2NyZWVuIiwidHlwZSIsIkJvb2xlYW4iLCJ2YWx1ZSIsImRlZmF1bHRJbmRleCIsIk51bWJlciIsImNvbXBvbmVudElkIiwiU3RyaW5nIiwiYW5pbWF0ZSIsInRleHRDb2xvciIsImFjdGl2ZVRleHRDb2xvciIsImxpbmVDb2xvciIsImFjdGl2ZUxpbmVDb2xvciIsImRhdGEiLCJ0YWJzIiwid2lkdGgiLCJhY3RpdmVLZXkiLCJtb3ZlIiwiYXR0YWNoZWQiLCJFdmVudCIsIm9uIiwidGFiIiwibGFiZWwiLCJwdXNoIiwicmVhZHkiLCJtaW5BbmRNYXgiLCJvblN3aXRjaCIsImxpc3RlblN3aXRjaCIsImxlbiIsImxlbmd0aCIsInBhcnNlSW50IiwiZW1pdCIsInNldERhdGEiLCJkZXRhY2hlZCIsInJlbW92ZUxpc3RlbmVyIiwibWV0aG9kcyIsIm1heCIsIm1pbiIsImtleSIsInRvTm90aWNlIiwiY3VycmVudFRhcmdldCIsImRhdGFzZXQiLCJpZHgiLCJhZnRlclN3aXRjaCIsInRyaWdnZXJFdmVudCJdLCJtYXBwaW5ncyI6Ijs7Ozs7O0FBQUE7Ozs7Ozs7QUFLRUEsV0FBUztBQUNQQyxtQkFBZSxJQURSLENBQ2E7QUFEYixHO0FBR1RDLGFBQVcsRTtBQUNYQyxjQUFZO0FBQ1ZDLGdCQUFZO0FBQ1ZDLFlBQU1DLE9BREk7QUFFVkMsYUFBTztBQUZHLEtBREY7QUFLVkMsa0JBQWM7QUFDWkgsWUFBTUksTUFETTtBQUVaRixhQUFPO0FBRkssS0FMSjtBQVNWRyxpQkFBYTtBQUNYTCxZQUFNTSxNQURLO0FBRVhKLGFBQU87QUFGSSxLQVRIO0FBYVZLLGFBQVM7QUFDUFAsWUFBTUMsT0FEQztBQUVQQyxhQUFPO0FBRkEsS0FiQztBQWlCVk0sZUFBVztBQUNUUixZQUFNTSxNQURHO0FBRVRKLGFBQU87QUFGRSxLQWpCRDtB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LEtBQUt6QixXQUFuQyxFQUFrRFUsU0FBbEQ7QUFDQUcsd0JBQU1ZLElBQU4sc0JBQThCLEtBQUt6QixXQUFuQyxFQUFrRFUsU0FBbEQ7QUFDRCxPQUhELE1BR087QUFDTEcsd0JBQU1ZLElBQU4sQ0FBY1EsUUFBZCxnQkFBaUMsS0FBS2pDLFdBQXRDLEVBQXFEVSxTQUFyRDtBQUNEOztBQUVELFdBQUsyQixXQUFMLENBQWlCM0IsU0FBakI7QUFDRCxLQTdDTTtBQStDUDJCLGVBL0NPLHVCQStDSzNCLFNBL0NMLEVBK0NnQjtBQUNyQixXQUFLNEIsWUFBTCxDQUFrQixXQUFsQixFQUErQjtBQUM3Qk4sYUFBS3RCLFNBRHdCO0FBRTdCVixxQkFBYSxLQUFLQTtBQUZXLE9BQS9CO0FBSUQ7QUFwRE0iLCJmaWxlIjoiaW5kZXgud3hjIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IEV2ZW50IGZyb20gJy4vRXZlbnQnO1xuZXhwb3J0IGRlZmF1bHQge1xuICBjb25maWc6IHtcbiAgICB1c2luZ0NvbXBvbmVudHM6IHt9XG4gIH0sXG4gIG9wdGlvbnM6IHtcbiAgICBtdWx0aXBsZVNsb3RzOiB0cnVlIC8vIHN1cHBvcnQgbXVsdGkgc2xvdFxuICB9LFxuICBiZWhhdmlvcnM6IFtdLFxuICBwcm9wZXJ0aWVzOiB7XG4gICAgZnVsbFNjcmVlbjoge1xuICAgICAgdHlwZTogQm9vbGVhbixcbiAgICAgIHZhbHVlOiBmYWxzZVxuICAgIH0sXG4gICAgZGVmYXVsdEluZGV4OiB7XG4gICAgICB0eXBlOiBOdW1iZXIsXG4gICAgICB2YWx1ZTogMFxuICAgIH0sXG4gICAgY29tcG9uZW50SWQ6IHtcbiAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgIHZhbHVlOiAnJ1xuICAgIH0sXG4gICAgYW5pbWF0ZToge1xuICAgICAgdHlwZTogQm9vbGVhbixcbiAgICAgIHZhbHVlOiBmYWxzZVxuICAgIH0sXG4gICAgdGV4dENvbG9yOiB7XG4gICAgICB0eXBlOiBTdHJpbmcsXG4gICAgICB2YWx1ZTogJyMwMDAnLFxuICAgIH0sXG4gICAgYWN0aXZlVGV4dENvbG9yOiB7XG4gICAgICB0eXBlOiBTdHJpbmcsXG4gICAgICB2YWx1ZTogJyNmZjU3NzcnLFxuICAgIH0sXG4gICAgbGluZUNvbG9yOiB7XG4gICAgICB0eXBlOiBTdHJpbmcsXG4gICAgICB2YWx1ZTogJyNkZGQnLFxuICAgIH0sXG4gICAgYWN0aXZlTGluZUNvbG9yOiB7XG4gICAgICB0eXBlOiBTdHJpbmcsXG4gICAgICB2YWx1ZTogJyNmZjU3NzcnLFxuICAgIH1cbiAgfSxcbiAgZGF0YToge1xuICAgIHRhYnM6IFtdLFxuICAgIHdpZHRoOiAwLFxuICAgIGFjdGl2ZUtleTogMCxcbiAgICBtb3ZlOiAwXG4gIH0sXG4gIGF0dGFjaGVkKCkge1xuICAgIHRoaXMuY29tcG9uZW50SWQgPSB0aGlzLmRhdGEuY29tcG9uZW50SWQ7XG4gICAgdGhpcy50YWJzID0gW107XG4gICAgRXZlbnQub24oYHRhYi1jcmVhdGUtJHt0aGlzLmNvbXBvbmVudElkfWAsIHRhYiA9PiB7XG4gICAgICB0aGlzLnR5cGUgPSAhdGFiLmxhYmVsID8gJ2NvbXBsZXgnIDogJ3NpbXBsZSc7XG4gICAgICB0aGlzLnRhYnMucHVzaCh0YWIpO1xuICAgIH0pO1xuICB9LFxuICByZWFkeSgpIHtcbiAgICBsZXQgYWN0aXZlS2V5ID0gdGhpcy5taW5BbmRNYXgodGhpcy5kYXRhLmRlZmF1bHRJbmRleCk7XG4gICAgdGhpcy5vblN3aXRjaChhY3RpdmVLZXksICdhbGwnKTtcbiAgICB0aGlzLmxpc3RlblN3aXRjaCgpO1xuICAgIC8vIGNvbnN0IHdpZHRoID0gdGhpcy50YWJzLmxlbmd0aCA8IDUgPyAoMTAwIC8gdGhpcy50YWJzLmxlbmd0aCkgOiAyNTtcbiAgICBsZXQgbGVuID0gdGhpcy50YWJzLmxlbmd0aDtcbiAgICBjb25zdCB3aWR0aCA9IHBhcnNlSW50KDc1MCAvIChsZW4gPiA1PyA1IDogbGVuKSlcbiAgICB0aGlzLnR5cGUgPT09ICdjb21wbGV4JyAmJiBFdmVudC5lbWl0KGBsYWJlbC13aWR0aC0ke3RoaXMuY29tcG9uZW50SWR9YCwgd2lkdGgpO1xuICAgIHRoaXMuc2V0RGF0YSh7XG4gICAgICB0YWJzOiB0aGlzLnRhYnMsXG4gICAgICB3aWR0aCxcbiAgICAgIHR5cGU6IHRoaXMudHlwZSxcbiAgICAgIG1vdmU6IHdpZHRoICogYWN0aXZlS2V5XG4gICAgfSk7XG4gIH0sXG4gIGRldGFjaGVkKCkge1xuICAgIEV2ZW50LnJlbW92ZUxpc3RlbmVyKCk7XG4gIH0sXG4gIG1ldGhvZHM6IHtcblxuICAgIC8vIGxpbWl0IGlucHV0IHJhbmdlXG4gICAgbWluQW5kTWF4KGFjdGl2ZUtleSkge1xuICAgICAgY29uc3QgbWF4ID0gdGhpcy50YWJzLmxlbmd0aCAtIDE7XG4gICAgICBjb25zdCBtaW4gPSAwO1xuICAgICAgaWYgKCBhY3RpdmVLZXkgPiBtYXggKSB7XG4gICAgICAgIHJldHVybiBtYXg7XG4gICAgICB9IGVsc2UgaWYgKGFjdGl2ZUtleSA8IG1pbil7XG4gICAgICAgIHJldHVybiAwO1xuICAgICAgfSBlbHNlIHtcbiAgICAgICAgcmV0dXJuIGFjdGl2ZUtleTtcbiAgICAgIH1cbiAgICB9LFxuXG4gICAgLy8gbGlzZW4gY2hpbGQgY29tcG9uZW50IHRhYiBldmVudFxuICAgIGxpc3RlblN3aXRjaCgpIHtcbiAgICAgIEV2ZW50Lm9uKGBmcm9tLWxhYmVsLXN3aXRjaC0ke3RoaXMuY29tcG9uZW50SWR9YCwga2V5ID0+IHtcbiAgICAgICAgdGhpcy5vblN3aXRjaChrZXksICd0by1wYW5lbCcpO1xuICAgICAgfSk7XG4gICAgICBFdmVudC5vbihgZnJvbS1wYW5lbC1zd2l0Y2gtJHt0aGlzLmNvbXBvbmVudElkfWAsIGtleSA9PiB7XG4gICAgICAgIHRoaXMub25Td2l0Y2goa2V5LCAndG8tbGFiZWwnKTtcbiAgICAgIH0pO1xuICAgIH0sXG5cbiAgICBvblN3aXRjaChhY3RpdmVLZXksIHRvTm90aWNlKSB7XG4gICAgICBpZiAoIXRvTm90aWNlKSB7XG4gICAgICAgIGFjdGl2ZUtleSA9IGFjdGl2ZUtleS5jdXJyZW50VGFyZ2V0LmRhdGFzZXQuaWR4O1xuICAgICAgICB0b05vdGljZSA9ICd0by1wYW5lbCc7XG4gICAgICB9XG4gICAgICBjb25zdCBtb3ZlID0gYWN0aXZlS2V5ICogdGhpcy5kYXRhLndpZHRoO1xuICAgICAgdGhpcy5zZXREYXRhKHtcbiAgICAgICAgYWN0aXZlS2V5LFxuICAgICAgICBtb3ZlXG4gICAgICB9KTtcblxuICAgICAgLy8gdG8gbm90aWNlIHBhbmVsIGFuZCBsYWJlbCB0YWIgaGFzIHN3aXRjaGVkXG4gICAgICBpZiAodG9Ob3RpY2UgPT09ICdhbGwnKSB7XG4gICAgICAgIEV2ZW50LmVtaXQoYHRvLWxhYmVsLXN3aXRjaC0ke3RoaXMuY29tcG9uZW50SWR9YCwgYWN0aXZlS2V5KTtcbiAgICAgICAgRXZlbnQuZW1pdChgdG8tcGFuZWwtc3dpdGNoLSR7dGhpcy5jb21wb25lbnRJZH1gLCBhY3RpdmVLZXkpO1xuICAgICAgfSBlbHNlIHtcbiAgICAgICAgRXZlbnQuZW1pdChgJHt0b05vdGljZX0tc3dpdGNoLSR7dGhpcy5jb21wb25lbnRJZH1gLCBhY3RpdmVLZXkpO1xuICAgICAgfVxuXG4gICAgICB0aGlzLmFmdGVyU3dpdGNoKGFjdGl2ZUtleSk7XG4gICAgfSxcblxuICAgIGFmdGVyU3dpdGNoKGFjdGl2ZUtleSkge1xuICAgICAgdGhpcy50cmlnZ2VyRXZlbnQoJ3RhYmNoYW5nZScsIHtcbiAgICAgICAga2V5OiBhY3RpdmVLZXksXG4gICAgICAgIGNvbXBvbmVudElkOiB0aGlzLmNvbXBvbmVudElkXG4gICAgICB9KTtcbiAgICB9XG5cbiAgfVxufSJdfQ==