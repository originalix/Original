'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = Component({
  behaviors: [],
  properties: {
    title: {
      type: String,
      value: ''
    },
    src: {
      type: String,
      value: ''
    },
    icon: {
      type: String,
      value: ''
    },
    iconColor: {
      type: String,
      value: ''
    },
    mode: {
      type: String,
      value: 'normal' // 输入框的模式选择，可选值：wrapped，有边框包裹, normal，只有下边框，none，无边框
    },
    right: {
      type: Boolean,
      value: false // 输入框是否居右显示
    },
    error: {
      type: Boolean,
      value: false
    },
    value: {
      type: String,
      value: ''
    },
    type: {
      type: String,
      value: 'text'
    },
    password: {
      type: Boolean,
      value: false
    },
    placeholder: {
      type: String,
      value: ''
    },
    placeholderStyle: {
      type: String,
      value: ''
    },
    disabled: {
      type: Boolean,
      value: false
    },
    maxlength: {
      type: [Number, String],
      value: 140
    },
    cursorSpacing: {
      type: [Number, String],
      value: 0
    },
    focus: {
      type: Boolean,
      value: false
    },
    confirmType: {
      type: String,
      value: 'done'
    },
    confirmHold: {
      type: Boolean,
      value: false
    },
    cursor: {
      type: [Number, String],
      value: 0
    },
    selectionStart: {
      type: [Number, String],
      value: -1
    },
    selectionEnd: {
      type: [Number, String],
      value: -1
    },
    adjustPosition: {
      type: Boolean,
      value: true
    }
  },
  data: {},
  methods: {
    onInput: function onInput(event) {
      var detail = event.detail;
      var option = {};
      this.triggerEvent('input', detail, option);
    },
    onFocus: function onFocus(event) {
      var detail = event.detail;
      var option = {};
      this.triggerEvent('focus', detail, option);
    },
    onBlur: function onBlur(event) {
      var detail = event.detail;
      var option = {};
      this.triggerEvent('blur', detail, option);
    },
    onConfirm: function onConfirm(event) {
      var detail = event.detail;
      var option = {};
      this.triggerEvent('confirm', detail, option);
    }
  }
});
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImluZGV4Lnd4YyJdLCJuYW1lcyI6WyJiZWhhdmlvcnMiLCJwcm9wZXJ0aWVzIiwidGl0bGUiLCJ0eXBlIiwiU3RyaW5nIiwidmFsdWUiLCJzcmMiLCJpY29uIiwiaWNvbkNvbG9yIiwibW9kZSIsInJpZ2h0IiwiQm9vbGVhbiIsImVycm9yIiwicGFzc3dvcmQiLCJwbGFjZWhvbGRlciIsInBsYWNlaG9sZGVyU3R5bGUiLCJkaXNhYmxlZCIsIm1heGxlbmd0aCIsIk51bWJlciIsImN1cnNvclNwYWNpbmciLCJmb2N1cyIsImNvbmZpcm1UeXBlIiwiY29uZmlybUhvbGQiLCJjdXJzb3IiLCJzZWxlY3Rpb25TdGFydCIsInNlbGVjdGlvbkVuZCIsImFkanVzdFBvc2l0aW9uIiwiZGF0YSIsIm1ldGhvZHMiLCJvbklucHV0IiwiZXZlbnQiLCJkZXRhaWwiLCJvcHRpb24iLCJ0cmlnZ2VyRXZlbnQiLCJvbkZvY3VzIiwib25CbHVyIiwib25Db25maXJtIl0sIm1hcHBpbmdzIjoiOzs7Ozs7QUFNRUEsYUFBVyxFO0FBQ1hDLGNBQVk7QUFDVkMsV0FBTztBQUNMQyxZQUFNQyxNQUREO0FBRUxDLGFBQU87QUFGRixLQURHO0FBS1ZDLFNBQUs7QUFDSEgsWUFBTUMsTUFESDtBQUVIQyxhQUFPO0FBRkosS0FMSztBQVNWRSxVQUFNO0FBQ0pKLFlBQU1DLE1BREY7QUFFSkMsYUFBTztBQUZILEtBVEk7QUFhVkcsZUFBVztBQUNUTCxZQUFNQyxNQURHO0FBRVRDLGFBQU87QUFGRSxLQWJEO0FBaUJWSSxVQUFNO0FBQ0pOLFlBQU1DLE1BREY7QUFFSkMsYUFBTyxRQUZILENBRVk7QUFGWixLQWpCSTtBQXFCVkssV0FBTztBQUNMUCxZQUFNUSxPQUREO0FBRUxOLGFBQU8sS0FGRixDQUVRO0FBRlIsS0FyQkc7QUF5QlZPLFdBQU87QUFDTFQsWUFBTVEsT0FERDtBQUVMTixhQUFPO0FBRkYsS0F6Qkc7QUE2QlZBLFdBQU87QUFDTEYsWUFBTUMsTUFERDtBQUVMQyxhQUFPO0FBRkYsS0E3Qkc7QUFpQ1ZGLFVBQU07QUFDSkEsWUFBTUMsTUFERjtBQUVKQyxhQUFPO0FBRkgsS0FqQ0k7QUFxQ1ZRLGNBQVU7QUFDUlYsWUFBTVEsT0FERTtBQUVSTixhQUFPO0FBRkMsS0FyQ0E7QUF5Q1ZTLGlCQUFhO0FBQ1hYLFlBQU1DLE1BREs7QUFFWEMsYUFBTztBQUZJLEtBekNIO0FBNkNWVSxzQkFBa0I7QUFDaEJaLFlBQU1DLE1BRFU7QUFFaEJDLGFBQU87QUFGUyxLQTdDUjtBQWlEVlcsY0FBVTtBQUNSYixZQUFNUSxPQURFO0FBRVJOLGFBQU87QUFGQyxLQWpEQTtBQXFEVlksZUFBVztBQUNUZCxZQUFNLENBQUNlLE1BQUQsRUFBU2QsTUFBVCxDQURHO0FBRVRDLGFBQU87QUFGRSxLQXJERDtBQXlEVmMsbUJBQWU7QUFDYmhCLFlBQU0sQ0FBQ2UsTUFBRCxFQUFTZCxNQUFULENBRE87QUFFYkMsYUFBTztBQUZNLEtBekRMO0FBNkRWZSxXQUFPO0FBQ0xqQixZQUFNUSxPQUREO0FBRUxOLGFBQU87QUFGRixLQTdERztBQWlFVmdCLGlCQUFhO0FBQ1hsQixZQUFNQyxNQURLO0FBRVhDLGFBQU87QUFGSSxLQWpFSDtBQXFFVmlCLGlCQUFhO0FBQ1huQixZQUFNUSxPQURLO0FBRVhOLGFBQU87QUFGSSxLQXJFSDtBQXlFVmtCLFlBQVE7QUFDTnBCLFlBQU0sQ0FBQ2UsTUFBRCxFQUFTZCxNQUFULENBREE7QUFFTkMsYUFBTztBQUZELEtBekVFO0FBNkVWbUIsb0JBQWdCO0FBQ2RyQixZQUFNLENBQUNlLE1BQUQsRUFBU2QsTUFBVCxDQURRO0FBRWRDLGFBQU8sQ0FBQztBQUZNLEtBN0VOO0FBaUZWb0Isa0JBQWM7QUFDWnRCLFlBQU0sQ0FBQ2UsTUFBRCxFQUFTZCxNQUFULENBRE07QUFFWkMsYUFBTyxDQUFDO0FBRkksS0FqRko7QUFxRlZxQixvQkFBZ0I7QUFDZHZCLFlBQU1RLE9BRFE7QUFFZE4sYUFBTztBQUZPO0FBckZOLEc7QUEwRlpzQixRQUFNLEU7QUFDTkMsV0FBUztBQUNQQyxXQURPLG1CQUNDQyxLQURELEVBQ1E7QUFDYixVQUFJQyxTQUFTRCxNQUFNQyxNQUFuQjtBQUNBLFVBQUlDLFNBQVMsRUFBYjtBQUNBLFdBQUtDLFlBQUwsQ0FBa0IsT0FBbEIsRUFBMkJGLE1BQTNCLEVBQW1DQyxNQUFuQztBQUNELEtBTE07QUFNUEUsV0FOTyxtQkFNQ0osS0FORCxFQU1RO0FBQ2IsVUFBSUMsU0FBU0QsTUFBTUMsTUFBbkI7QUFDQSxVQUFJQyxTQUFTLEVBQWI7QUFDQSxXQUFLQyxZQUFMLENBQWtCLE9BQWxCLEVBQTJCRixNQUEzQixFQUFtQ0MsTUFBbkM7QUFDRCxLQVZNO0FBV1BHLFVBWE8sa0JBV0FMLEtBWEEsRUFXTztBQUNaLFVBQUlDLFNBQVNELE1BQU1DLE1BQW5CO0FBQ0EsVUFBSUMsU0FBUyxFQUFiO0FBQ0EsV0FBS0MsWUFBTCxDQUFrQixNQUFsQixFQUEwQkYsTUFBMUIsRUFBa0NDLE1BQWxDO0FBQ0QsS0FmTTtBQWdCUEksYUFoQk8scUJBZ0JHTixLQWhCSCxFQWdCVTtBQUNmLFVBQUlDLFNBQVNELE1BQU1DLE1BQW5CO0FBQ0EsVUFBSUMsU0FBUyxFQUFiO0FBQ0EsV0FBS0MsWUFBTCxDQUFrQixTQUFsQixFQUE2QkYsTUFBN0IsRUFBcUNDLE1BQXJDO0FBQ0Q7QUFwQk0iLCJmaWxlIjoiaW5kZXgud3hjIiwic291cmNlc0NvbnRlbnQiOlsiZXhwb3J0IGRlZmF1bHQge1xuICBjb25maWc6IHtcbiAgICB1c2luZ0NvbXBvbmVudHM6IHtcbiAgICAgICd3eGMtaWNvbic6ICdAbWludWkvd3hjLWljb24nXG4gICAgfVxuICB9LFxuICBiZWhhdmlvcnM6IFtdLFxuICBwcm9wZXJ0aWVzOiB7XG4gICAgdGl0bGU6IHtcbiAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgIHZhbHVlOiAnJ1xuICAgIH0sXG4gICAgc3JjOiB7XG4gICAgICB0eXBlOiBTdHJpbmcsXG4gICAgICB2YWx1ZTogJydcbiAgICB9LFxuICAgIGljb246IHtcbiAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgIHZhbHVlOiAnJ1xuICAgIH0sXG4gICAgaWNvbkNvbG9yOiB7XG4gICAgICB0eXBlOiBTdHJpbmcsXG4gICAgICB2YWx1ZTogJydcbiAgICB9LFxuICAgIG1vZGU6IHtcbiAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgIHZhbHVlOiAnbm9ybWFsJyAvLyDovpPlhaXmoYbnmoTmqKHlvI/pgInmi6nvvIzlj6/pgInlgLzvvJp3cmFwcGVk77yM5pyJ6L655qGG5YyF6KO5LCBub3JtYWzvvIzlj6rmnInkuIvovrnmoYbvvIxub25l77yM5peg6L655qGGXG4gICAgfSxcbiAgICByaWdodDoge1xuICAgICAgdHlwZTogQm9vbGVhbixcbiAgICAgIHZhbHVlOiBmYWxzZSAvLyDovpPlhaXmoYbmmK/lkKblsYXlj7PmmL7npLpcbiAgICB9LFxuICAgIGVycm9yOiB7XG4gICAgICB0eXBlOiBCb29sZWFuLFxuICAgICAgdmFsdWU6IGZhbHNlXG4gICAgfSxcbiAgICB2YWx1ZToge1xuICAgICAgdHlwZTogU3RyaW5nLFxuICAgICAgdmFsdWU6ICcnXG4gICAgfSxcbiAgICB0eXBlOiB7XG4gICAgICB0eXBlOiBTdHJpbmcsXG4gICAgICB2YWx1ZTogJ3RleHQnXG4gICAgfSxcbiAgICBwYXNzd29yZDoge1xuICAgICAgdHlwZTogQm9vbGVhbixcbiAgICAgIHZhbHVlOiBmYWxzZVxuICAgIH0sXG4gICAgcGxhY2Vob2xkZXI6IHtcbiAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgIHZhbHVlOiAnJ1xuICAgIH0sXG4gICAgcGxhY2Vob2xkZXJTdHlsZToge1xuICAgICAgdHlwZTogU3RyaW5nLFxuICAgICAgdmFsdWU6ICcnXG4gICAgfSxcbiAgICBkaXNhYmxlZDoge1xuICAgICAgdHlwZTogQm9vbGVhbixcbiAgICAgIHZhbHVlOiBmYWxzZVxuICAgIH0sXG4gICAgbWF4bGVuZ3RoOiB7XG4gICAgICB0eXBlOiBbTnVtYmVyLCBTdHJpbmddLFxuICAgICAgdmFsdWU6IDE0MFxuICAgIH0sXG4gICAgY3Vyc29yU3BhY2luZzoge1xuICAgICAgdHlwZTogW051bWJlciwgU3RyaW5nXSxcbiAgICAgIHZhbHVlOiAwXG4gICAgfSxcbiAgICBmb2N1czoge1xuICAgICAgdHlwZTogQm9vbGVhbixcbiAgICAgIHZhbHVlOiBmYWxzZVxuICAgIH0sXG4gICAgY29uZmlybVR5cGU6IHtcbiAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgIHZhbHVlOiAnZG9uZSdcbiAgICB9LFxuICAgIGNvbmZpcm1Ib2xkOiB7XG4gICAgICB0eXBlOiBCb29sZWFuLFxuICAgICAgdmFsdWU6IGZhbHNlXG4gICAgfSxcbiAgICBjdXJzb3I6IHtcbiAgICAgIHR5cGU6IFtOdW1iZXIsIFN0cmluZ10sXG4gICAgICB2YWx1ZTogMFxuICAgIH0sXG4gICAgc2VsZWN0aW9uU3RhcnQ6IHtcbiAgICAgIHR5cGU6IFtOdW1iZXIsIFN0cmluZ10sXG4gICAgICB2YWx1ZTogLTFcbiAgICB9LFxuICAgIHNlbGVjdGlvbkVuZDoge1xuICAgICAgdHlwZTogW051bWJlciwgU3RyaW5nXSxcbiAgICAgIHZhbHVlOiAtMVxuICAgIH0sXG4gICAgYWRqdXN0UG9zaXRpb246IHtcbiAgICAgIHR5cGU6IEJvb2xlYW4sXG4gICAgICB2YWx1ZTogdHJ1ZVxuICAgIH1cbiAgfSxcbiAgZGF0YTogeyB9LFxuICBtZXRob2RzOiB7XG4gICAgb25JbnB1dChldmVudCkge1xuICAgICAgbGV0IGRldGFpbCA9IGV2ZW50LmRldGFpbDtcbiAgICAgIGxldCBvcHRpb24gPSB7fTtcbiAgICAgIHRoaXMudHJpZ2dlckV2ZW50KCdpbnB1dCcsIGRldGFpbCwgb3B0aW9uKTtcbiAgICB9LFxuICAgIG9uRm9jdXMoZXZlbnQpIHtcbiAgICAgIGxldCBkZXRhaWwgPSBldmVudC5kZXRhaWw7XG4gICAgICBsZXQgb3B0aW9uID0ge307XG4gICAgICB0aGlzLnRyaWdnZXJFdmVudCgnZm9jdXMnLCBkZXRhaWwsIG9wdGlvbik7XG4gICAgfSxcbiAgICBvbkJsdXIoZXZlbnQpIHtcbiAgICAgIGxldCBkZXRhaWwgPSBldmVudC5kZXRhaWw7XG4gICAgICBsZXQgb3B0aW9uID0ge307XG4gICAgICB0aGlzLnRyaWdnZXJFdmVudCgnYmx1cicsIGRldGFpbCwgb3B0aW9uKTtcbiAgICB9LFxuICAgIG9uQ29uZmlybShldmVudCkge1xuICAgICAgbGV0IGRldGFpbCA9IGV2ZW50LmRldGFpbDtcbiAgICAgIGxldCBvcHRpb24gPSB7fTtcbiAgICAgIHRoaXMudHJpZ2dlckV2ZW50KCdjb25maXJtJywgZGV0YWlsLCBvcHRpb24pO1xuICAgIH1cbiAgfVxufSJdfQ==