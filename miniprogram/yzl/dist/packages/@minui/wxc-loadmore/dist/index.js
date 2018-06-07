'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _config = require('./config.js');

exports.default = Component({
  behaviors: [],
  properties: {
    text: {
      type: String,
      value: ''
    },
    isEnd: {
      type: Boolean,
      value: false
    },
    icon: {
      type: String
    }
  },
  data: {
    type: _config.TYPES[Math.floor(Math.random() * _config.TYPES.length)],
    iconStatus: _config.IconType.HIDDEN,
    iconType: _config.IconType
  },
  attached: function attached() {
    var iconStatus = _config.IconType.HIDDEN;
    var icon = this.data.icon;
    if (icon) {
      iconStatus = _config.IconType.SHOW_DEFAULT;
    }
    if (/\.(jpg|gif|jpeg|png)+$/.test(icon)) {
      iconStatus = _config.IconType.SHOW_CONFIG;
    }
    this.setData({
      iconStatus: iconStatus
    });
  },

  methods: {}
});
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImluZGV4Lnd4YyJdLCJuYW1lcyI6WyJiZWhhdmlvcnMiLCJwcm9wZXJ0aWVzIiwidGV4dCIsInR5cGUiLCJTdHJpbmciLCJ2YWx1ZSIsImlzRW5kIiwiQm9vbGVhbiIsImljb24iLCJkYXRhIiwiVFlQRVMiLCJNYXRoIiwiZmxvb3IiLCJyYW5kb20iLCJsZW5ndGgiLCJpY29uU3RhdHVzIiwiSWNvblR5cGUiLCJISURERU4iLCJpY29uVHlwZSIsImF0dGFjaGVkIiwiU0hPV19ERUZBVUxUIiwidGVzdCIsIlNIT1dfQ09ORklHIiwic2V0RGF0YSIsIm1ldGhvZHMiXSwibWFwcGluZ3MiOiI7Ozs7OztBQUFBOzs7QUFNRUEsYUFBVyxFO0FBQ1hDLGNBQVk7QUFDVkMsVUFBTTtBQUNKQyxZQUFNQyxNQURGO0FBRUpDLGFBQU87QUFGSCxLQURJO0FBS1ZDLFdBQU87QUFDTEgsWUFBTUksT0FERDtBQUVMRixhQUFPO0FBRkYsS0FMRztBQVNWRyxVQUFNO0FBQ0pMLFlBQU1DO0FBREY7QUFUSSxHO0FBYVpLLFFBQU07QUFDSk4sVUFBTU8sY0FBTUMsS0FBS0MsS0FBTCxDQUFXRCxLQUFLRSxNQUFMLEtBQWdCSCxjQUFNSSxNQUFqQyxDQUFOLENBREY7QUFFSkMsZ0JBQVlDLGlCQUFTQyxNQUZqQjtBQUdKQyxjQUFVRjtBQUhOLEc7QUFLTkcsVSxzQkFBVztBQUNULFFBQUlKLGFBQWFDLGlCQUFTQyxNQUExQjtBQUNBLFFBQU1ULE9BQU8sS0FBS0MsSUFBTCxDQUFVRCxJQUF2QjtBQUNBLFFBQUlBLElBQUosRUFBVTtBQUNSTyxtQkFBYUMsaUJBQVNJLFlBQXRCO0FBQ0Q7QUFDRCxRQUFLLHdCQUFELENBQTJCQyxJQUEzQixDQUFnQ2IsSUFBaEMsQ0FBSixFQUEyQztBQUN6Q08sbUJBQWFDLGlCQUFTTSxXQUF0QjtBQUNEO0FBQ0QsU0FBS0MsT0FBTCxDQUFhO0FBQ1hSO0FBRFcsS0FBYjtBQUdELEc7O0FBQ0RTLFdBQVMiLCJmaWxlIjoiaW5kZXgud3hjIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IHsgVFlQRVMsIEljb25UeXBlIH0gZnJvbSAnLi9jb25maWcnO1xuXG5leHBvcnQgZGVmYXVsdCB7XG4gIGNvbmZpZzoge1xuICAgIHVzaW5nQ29tcG9uZW50czoge31cbiAgfSxcbiAgYmVoYXZpb3JzOiBbXSxcbiAgcHJvcGVydGllczoge1xuICAgIHRleHQ6IHtcbiAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgIHZhbHVlOiAnJ1xuICAgIH0sXG4gICAgaXNFbmQ6IHtcbiAgICAgIHR5cGU6IEJvb2xlYW4sXG4gICAgICB2YWx1ZTogZmFsc2VcbiAgICB9LFxuICAgIGljb246IHtcbiAgICAgIHR5cGU6IFN0cmluZ1xuICAgIH1cbiAgfSxcbiAgZGF0YToge1xuICAgIHR5cGU6IFRZUEVTW01hdGguZmxvb3IoTWF0aC5yYW5kb20oKSAqIFRZUEVTLmxlbmd0aCldLFxuICAgIGljb25TdGF0dXM6IEljb25UeXBlLkhJRERFTixcbiAgICBpY29uVHlwZTogSWNvblR5cGVcbiAgfSxcbiAgYXR0YWNoZWQoKSB7XG4gICAgbGV0IGljb25TdGF0dXMgPSBJY29uVHlwZS5ISURERU47XG4gICAgY29uc3QgaWNvbiA9IHRoaXMuZGF0YS5pY29uO1xuICAgIGlmIChpY29uKSB7XG4gICAgICBpY29uU3RhdHVzID0gSWNvblR5cGUuU0hPV19ERUZBVUxUO1xuICAgIH1cbiAgICBpZiAoKC9cXC4oanBnfGdpZnxqcGVnfHBuZykrJC8pLnRlc3QoaWNvbikpIHtcbiAgICAgIGljb25TdGF0dXMgPSBJY29uVHlwZS5TSE9XX0NPTkZJRztcbiAgICB9XG4gICAgdGhpcy5zZXREYXRhKHtcbiAgICAgIGljb25TdGF0dXNcbiAgICB9KVxuICB9LFxuICBtZXRob2RzOiB7fVxufSJdfQ==