'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _config = require('./config.js');

var _config2 = _interopRequireDefault(_config);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = Component({
  behaviors: [],
  properties: {
    type: {
      type: String,
      value: '',
      observer: function observer(type) {
        if (type && _config2.default[type]) {
          var image = this.data.image || _config2.default[type].image;
          var title = this.data.title || _config2.default[type].title;
          var button = this.data.button || _config2.default[type].button;
          var tip = this.data.tip || _config2.default[type].tip;
          this.setData({
            image: image,
            title: title,
            button: button,
            tip: tip
          });
        }
      }
    },
    image: {
      type: String,
      value: ''
    },
    title: {
      type: String,
      value: ''
    },
    tip: {
      type: String,
      value: ''
    },
    button: {
      type: String,
      value: ''
    }
  },
  data: {},
  methods: {
    emitAbnorTap: function emitAbnorTap(event) {
      var detail = event.detail;
      var option = {};
      this.triggerEvent('abnortap', detail, option);
    }
  }
});
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImluZGV4Lnd4YyJdLCJuYW1lcyI6WyJiZWhhdmlvcnMiLCJwcm9wZXJ0aWVzIiwidHlwZSIsIlN0cmluZyIsInZhbHVlIiwib2JzZXJ2ZXIiLCJUeXBlcyIsImltYWdlIiwiZGF0YSIsInRpdGxlIiwiYnV0dG9uIiwidGlwIiwic2V0RGF0YSIsIm1ldGhvZHMiLCJlbWl0QWJub3JUYXAiLCJldmVudCIsImRldGFpbCIsIm9wdGlvbiIsInRyaWdnZXJFdmVudCJdLCJtYXBwaW5ncyI6Ijs7Ozs7O0FBQUE7Ozs7Ozs7QUFNSUEsYUFBVyxFO0FBQ1hDLGNBQVk7QUFDVkMsVUFBTTtBQUNKQSxZQUFNQyxNQURGO0FBRUpDLGFBQU8sRUFGSDtBQUdKQyxjQUhJLG9CQUdLSCxJQUhMLEVBR1c7QUFDYixZQUFJQSxRQUFRSSxpQkFBTUosSUFBTixDQUFaLEVBQXlCO0FBQ3ZCLGNBQUlLLFFBQVEsS0FBS0MsSUFBTCxDQUFVRCxLQUFWLElBQW1CRCxpQkFBTUosSUFBTixFQUFZSyxLQUEzQztBQUNBLGNBQUlFLFFBQVEsS0FBS0QsSUFBTCxDQUFVQyxLQUFWLElBQW1CSCxpQkFBTUosSUFBTixFQUFZTyxLQUEzQztBQUNBLGNBQUlDLFNBQVMsS0FBS0YsSUFBTCxDQUFVRSxNQUFWLElBQW9CSixpQkFBTUosSUFBTixFQUFZUSxNQUE3QztBQUNBLGNBQUlDLE1BQU0sS0FBS0gsSUFBTCxDQUFVRyxHQUFWLElBQWlCTCxpQkFBTUosSUFBTixFQUFZUyxHQUF2QztBQUNBLGVBQUtDLE9BQUwsQ0FBYTtBQUNYTCx3QkFEVztBQUVYRSx3QkFGVztBQUdYQywwQkFIVztBQUlYQztBQUpXLFdBQWI7QUFNRDtBQUNGO0FBaEJHLEtBREk7QUFtQlZKLFdBQU87QUFDTEwsWUFBTUMsTUFERDtBQUVMQyxhQUFPO0FBRkYsS0FuQkc7QUF1QlZLLFdBQU87QUFDTFAsWUFBTUMsTUFERDtBQUVMQyxhQUFPO0FBRkYsS0F2Qkc7QUEyQlZPLFNBQUs7QUFDSFQsWUFBTUMsTUFESDtBQUVIQyxhQUFPO0FBRkosS0EzQks7QUErQlZNLFlBQVE7QUFDTlIsWUFBTUMsTUFEQTtBQUVOQyxhQUFPO0FBRkQ7QUEvQkUsRztBQW9DWkksUUFBTSxFO0FBQ05LLFdBQVM7QUFDUEMsZ0JBRE8sd0JBQ01DLEtBRE4sRUFDYTtBQUNsQixVQUFJQyxTQUFTRCxNQUFNQyxNQUFuQjtBQUNBLFVBQUlDLFNBQVMsRUFBYjtBQUNBLFdBQUtDLFlBQUwsQ0FBa0IsVUFBbEIsRUFBOEJGLE1BQTlCLEVBQXNDQyxNQUF0QztBQUNEO0FBTE0iLCJmaWxlIjoiaW5kZXgud3hjIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IFR5cGVzIGZyb20gJy4vY29uZmlnJ1xuXG4gIGV4cG9ydCBkZWZhdWx0IHtcbiAgICBjb25maWc6IHtcbiAgICAgIHVzaW5nQ29tcG9uZW50czoge31cbiAgICB9LFxuICAgIGJlaGF2aW9yczogW10sXG4gICAgcHJvcGVydGllczoge1xuICAgICAgdHlwZToge1xuICAgICAgICB0eXBlOiBTdHJpbmcsXG4gICAgICAgIHZhbHVlOiAnJyxcbiAgICAgICAgb2JzZXJ2ZXIodHlwZSkge1xuICAgICAgICAgIGlmICh0eXBlICYmIFR5cGVzW3R5cGVdKSB7XG4gICAgICAgICAgICBsZXQgaW1hZ2UgPSB0aGlzLmRhdGEuaW1hZ2UgfHwgVHlwZXNbdHlwZV0uaW1hZ2U7XG4gICAgICAgICAgICBsZXQgdGl0bGUgPSB0aGlzLmRhdGEudGl0bGUgfHwgVHlwZXNbdHlwZV0udGl0bGU7XG4gICAgICAgICAgICBsZXQgYnV0dG9uID0gdGhpcy5kYXRhLmJ1dHRvbiB8fCBUeXBlc1t0eXBlXS5idXR0b247XG4gICAgICAgICAgICBsZXQgdGlwID0gdGhpcy5kYXRhLnRpcCB8fCBUeXBlc1t0eXBlXS50aXA7XG4gICAgICAgICAgICB0aGlzLnNldERhdGEoe1xuICAgICAgICAgICAgICBpbWFnZSxcbiAgICAgICAgICAgICAgdGl0bGUsXG4gICAgICAgICAgICAgIGJ1dHRvbixcbiAgICAgICAgICAgICAgdGlwXG4gICAgICAgICAgICB9KVxuICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgICAgfSxcbiAgICAgIGltYWdlOiB7XG4gICAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgICAgdmFsdWU6ICcnXG4gICAgICB9LFxuICAgICAgdGl0bGU6IHtcbiAgICAgICAgdHlwZTogU3RyaW5nLFxuICAgICAgICB2YWx1ZTogJydcbiAgICAgIH0sXG4gICAgICB0aXA6IHtcbiAgICAgICAgdHlwZTogU3RyaW5nLFxuICAgICAgICB2YWx1ZTogJydcbiAgICAgIH0sXG4gICAgICBidXR0b246IHtcbiAgICAgICAgdHlwZTogU3RyaW5nLFxuICAgICAgICB2YWx1ZTogJydcbiAgICAgIH1cbiAgICB9LFxuICAgIGRhdGE6IHt9LFxuICAgIG1ldGhvZHM6IHtcbiAgICAgIGVtaXRBYm5vclRhcChldmVudCkge1xuICAgICAgICBsZXQgZGV0YWlsID0gZXZlbnQuZGV0YWlsO1xuICAgICAgICBsZXQgb3B0aW9uID0ge307XG4gICAgICAgIHRoaXMudHJpZ2dlckV2ZW50KCdhYm5vcnRhcCcsIGRldGFpbCwgb3B0aW9uKTtcbiAgICAgIH1cbiAgICB9XG4gIH0iXX0=