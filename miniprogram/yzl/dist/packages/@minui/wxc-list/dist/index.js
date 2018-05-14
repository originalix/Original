'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = Component({
  behaviors: [],
  properties: {
    title: {
      type: String,
      value: '' // 标题
    },
    detail: {
      type: String,
      value: '' // 标题下方的具体描述
    },
    desc: {
      type: String,
      value: '' // 右侧描述部分
    },
    icon: {
      type: String,
      value: '' // 标题左侧icon pintuan
    },
    iconColor: {
      type: String,
      value: '#ff5077' // 标题左侧icon颜色
    },
    src: {
      type: String,
      value: '' // 标题左侧icon图片链接
    },
    dot: {
      type: Boolean,
      value: false // 右侧描述部分的左侧红点
    },
    dotColor: {
      type: String,
      value: '#f5123e' // 右侧描述部分的左侧红点颜色
    },
    arrow: {
      type: Boolean,
      value: true // 是否显示箭头
    },
    mode: {
      type: String,
      value: 'normal' // 有边框和无边框 normal, none
    }
  },
  data: {},
  methods: {
    onClick: function onClick(event) {
      var detail = event.detail;
      var option = {};
      this.triggerEvent('click', detail, option);
    }
  }
});
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImluZGV4Lnd4YyJdLCJuYW1lcyI6WyJiZWhhdmlvcnMiLCJwcm9wZXJ0aWVzIiwidGl0bGUiLCJ0eXBlIiwiU3RyaW5nIiwidmFsdWUiLCJkZXRhaWwiLCJkZXNjIiwiaWNvbiIsImljb25Db2xvciIsInNyYyIsImRvdCIsIkJvb2xlYW4iLCJkb3RDb2xvciIsImFycm93IiwibW9kZSIsImRhdGEiLCJtZXRob2RzIiwib25DbGljayIsImV2ZW50Iiwib3B0aW9uIiwidHJpZ2dlckV2ZW50Il0sIm1hcHBpbmdzIjoiOzs7Ozs7QUFNRUEsYUFBVyxFO0FBQ1hDLGNBQVk7QUFDVkMsV0FBTztBQUNMQyxZQUFNQyxNQUREO0FBRUxDLGFBQU8sRUFGRixDQUVLO0FBRkwsS0FERztBQUtWQyxZQUFRO0FBQ05ILFlBQU1DLE1BREE7QUFFTkMsYUFBTyxFQUZELENBRUk7QUFGSixLQUxFO0FBU1ZFLFVBQU07QUFDSkosWUFBTUMsTUFERjtBQUVKQyxhQUFPLEVBRkgsQ0FFTTtBQUZOLEtBVEk7QUFhVkcsVUFBTTtBQUNKTCxZQUFNQyxNQURGO0FBRUpDLGFBQU8sRUFGSCxDQUVNO0FBRk4sS0FiSTtBQWlCVkksZUFBVztBQUNUTixZQUFNQyxNQURHO0FBRVRDLGFBQU8sU0FGRSxDQUVRO0FBRlIsS0FqQkQ7QUFxQlZLLFNBQUs7QUFDSFAsWUFBTUMsTUFESDtBQUVIQyxhQUFPLEVBRkosQ0FFTztBQUZQLEtBckJLO0FBeUJWTSxTQUFLO0FBQ0hSLFlBQU1TLE9BREg7QUFFSFAsYUFBTyxLQUZKLENBRVU7QUFGVixLQXpCSztBQTZCVlEsY0FBVTtBQUNSVixZQUFNQyxNQURFO0FBRVJDLGFBQU8sU0FGQyxDQUVTO0FBRlQsS0E3QkE7QUFpQ1ZTLFdBQU87QUFDTFgsWUFBTVMsT0FERDtBQUVMUCxhQUFPLElBRkYsQ0FFUTtBQUZSLEtBakNHO0FBcUNWVSxVQUFNO0FBQ0paLFlBQU1DLE1BREY7QUFFSkMsYUFBTyxRQUZILENBRVk7QUFGWjtBQXJDSSxHO0FBMENaVyxRQUFNLEU7QUFDTkMsV0FBUztBQUNQQyxXQURPLG1CQUNDQyxLQURELEVBQ1E7QUFDYixVQUFJYixTQUFTYSxNQUFNYixNQUFuQjtBQUNBLFVBQUljLFNBQVMsRUFBYjtBQUNBLFdBQUtDLFlBQUwsQ0FBa0IsT0FBbEIsRUFBMkJmLE1BQTNCLEVBQW1DYyxNQUFuQztBQUNEO0FBTE0iLCJmaWxlIjoiaW5kZXgud3hjIiwic291cmNlc0NvbnRlbnQiOlsiZXhwb3J0IGRlZmF1bHQge1xuICBjb25maWc6IHtcbiAgICB1c2luZ0NvbXBvbmVudHM6IHtcbiAgICAgICd3eGMtaWNvbic6ICdAbWludWkvd3hjLWljb24nXG4gICAgfVxuICB9LFxuICBiZWhhdmlvcnM6IFsgXSxcbiAgcHJvcGVydGllczoge1xuICAgIHRpdGxlOiB7XG4gICAgICB0eXBlOiBTdHJpbmcsXG4gICAgICB2YWx1ZTogJycgLy8g5qCH6aKYXG4gICAgfSxcbiAgICBkZXRhaWw6IHtcbiAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgIHZhbHVlOiAnJyAvLyDmoIfpopjkuIvmlrnnmoTlhbfkvZPmj4/ov7BcbiAgICB9LFxuICAgIGRlc2M6IHtcbiAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgIHZhbHVlOiAnJyAvLyDlj7Pkvqfmj4/ov7Dpg6jliIZcbiAgICB9LFxuICAgIGljb246IHtcbiAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgIHZhbHVlOiAnJyAvLyDmoIfpopjlt6bkvqdpY29uIHBpbnR1YW5cbiAgICB9LFxuICAgIGljb25Db2xvcjoge1xuICAgICAgdHlwZTogU3RyaW5nLFxuICAgICAgdmFsdWU6ICcjZmY1MDc3JyAvLyDmoIfpopjlt6bkvqdpY29u6aKc6ImyXG4gICAgfSxcbiAgICBzcmM6IHtcbiAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgIHZhbHVlOiAnJyAvLyDmoIfpopjlt6bkvqdpY29u5Zu+54mH6ZO+5o6lXG4gICAgfSxcbiAgICBkb3Q6IHtcbiAgICAgIHR5cGU6IEJvb2xlYW4sXG4gICAgICB2YWx1ZTogZmFsc2UgLy8g5Y+z5L6n5o+P6L+w6YOo5YiG55qE5bem5L6n57qi54K5XG4gICAgfSxcbiAgICBkb3RDb2xvcjoge1xuICAgICAgdHlwZTogU3RyaW5nLFxuICAgICAgdmFsdWU6ICcjZjUxMjNlJyAvLyDlj7Pkvqfmj4/ov7Dpg6jliIbnmoTlt6bkvqfnuqLngrnpopzoibJcbiAgICB9LFxuICAgIGFycm93OiB7XG4gICAgICB0eXBlOiBCb29sZWFuLFxuICAgICAgdmFsdWU6IHRydWUgIC8vIOaYr+WQpuaYvuekuueureWktFxuICAgIH0sXG4gICAgbW9kZToge1xuICAgICAgdHlwZTogU3RyaW5nLFxuICAgICAgdmFsdWU6ICdub3JtYWwnIC8vIOaciei+ueahhuWSjOaXoOi+ueahhiBub3JtYWwsIG5vbmVcbiAgICB9XG4gIH0sXG4gIGRhdGE6IHsgfSxcbiAgbWV0aG9kczoge1xuICAgIG9uQ2xpY2soZXZlbnQpIHtcbiAgICAgIGxldCBkZXRhaWwgPSBldmVudC5kZXRhaWw7XG4gICAgICBsZXQgb3B0aW9uID0ge307XG4gICAgICB0aGlzLnRyaWdnZXJFdmVudCgnY2xpY2snLCBkZXRhaWwsIG9wdGlvbik7XG4gICAgfVxuICB9XG59Il19