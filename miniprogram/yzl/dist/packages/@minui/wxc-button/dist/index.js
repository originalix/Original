"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = Component({
    behaviors: [],
    properties: {
        size: {
            type: String,
            value: "normal" // normal small large
        },
        type: {
            type: String,
            value: '' //beauty selection success primary danger warning secondary info dark disabled  按钮的样式类型
        },
        plain: {
            type: Boolean,
            value: false // 按钮是否镂空，背景色透明
        },
        value: {
            type: String,
            value: ""
        },
        hoverClass: {
            type: String,
            value: "btn__hover" // btn__hover none
        },
        loading: {
            type: Boolean,
            value: false // 名称前是否带 loading 图标
        },
        btnStyle: {
            type: String,
            value: ""
        },
        openType: {
            type: String,
            value: ""
        },
        appParameter: {
            type: String,
            value: ""
        },
        hoverStopPropagation: {
            type: Boolean,
            value: false
        },
        hoverStartTime: {
            type: [Number, String],
            value: 20
        },
        hoverStayTime: {
            type: [Number, String],
            value: 70
        },
        lang: {
            type: String,
            value: "en"
        },
        sessionFrom: {
            type: String,
            value: ""
        },
        sendMessageTitle: {
            type: String,
            value: ""
        },
        sendMessagePath: {
            type: String,
            value: ""
        },
        sendMessageImg: {
            type: String,
            value: ""
        },
        showMessageCard: {
            type: Boolean,
            value: false
        }

    },
    data: {},
    methods: {
        onSubmit: function onSubmit(event) {
            var detail = event.detail;
            var option = {};
            this.triggerEvent('submit', detail, option);
        },
        btnClick: function btnClick(event) {
            var detail = event.detail;
            var option = {};
            this.triggerEvent('tap', detail, option);
        },
        getUserInfo: function getUserInfo(event) {
            var detail = event.detail;
            var option = {};
            this.triggerEvent('getuserinfo', detail, option);
        },
        onContact: function onContact(event) {
            var detail = event.detail;
            var option = {};
            this.triggerEvent('contact', detail, option);
        },
        getPhoneNumber: function getPhoneNumber(event) {
            var detail = event.detail;
            var option = {};
            this.triggerEvent('getphonenumber', detail, option);
        },
        onError: function onError(event) {
            var detail = event.detail;
            var option = {};
            this.triggerEvent('errror', detail, option);
        }
    }
});
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImluZGV4Lnd4YyJdLCJuYW1lcyI6WyJiZWhhdmlvcnMiLCJwcm9wZXJ0aWVzIiwic2l6ZSIsInR5cGUiLCJTdHJpbmciLCJ2YWx1ZSIsInBsYWluIiwiQm9vbGVhbiIsImhvdmVyQ2xhc3MiLCJsb2FkaW5nIiwiYnRuU3R5bGUiLCJvcGVuVHlwZSIsImFwcFBhcmFtZXRlciIsImhvdmVyU3RvcFByb3BhZ2F0aW9uIiwiaG92ZXJTdGFydFRpbWUiLCJOdW1iZXIiLCJob3ZlclN0YXlUaW1lIiwibGFuZyIsInNlc3Npb25Gcm9tIiwic2VuZE1lc3NhZ2VUaXRsZSIsInNlbmRNZXNzYWdlUGF0aCIsInNlbmRNZXNzYWdlSW1nIiwic2hvd01lc3NhZ2VDYXJkIiwiZGF0YSIsIm1ldGhvZHMiLCJvblN1Ym1pdCIsImV2ZW50IiwiZGV0YWlsIiwib3B0aW9uIiwidHJpZ2dlckV2ZW50IiwiYnRuQ2xpY2siLCJnZXRVc2VySW5mbyIsIm9uQ29udGFjdCIsImdldFBob25lTnVtYmVyIiwib25FcnJvciJdLCJtYXBwaW5ncyI6Ijs7Ozs7O0FBSVFBLGVBQVcsRTtBQUNYQyxnQkFBWTtBQUNSQyxjQUFNO0FBQ0ZDLGtCQUFNQyxNQURKO0FBRUZDLG1CQUFPLFFBRkwsQ0FFYztBQUZkLFNBREU7QUFLUkYsY0FBTTtBQUNGQSxrQkFBTUMsTUFESjtBQUVGQyxtQkFBTyxFQUZMLENBRVE7QUFGUixTQUxFO0FBU1JDLGVBQU87QUFDSEgsa0JBQU1JLE9BREg7QUFFSEYsbUJBQU8sS0FGSixDQUVVO0FBRlYsU0FUQztBQWFSQSxlQUFPO0FBQ0hGLGtCQUFNQyxNQURIO0FBRUhDLG1CQUFPO0FBRkosU0FiQztBQWlCUkcsb0JBQVk7QUFDUkwsa0JBQU1DLE1BREU7QUFFUkMsbUJBQU8sWUFGQyxDQUVZO0FBRlosU0FqQko7QUFxQlJJLGlCQUFTO0FBQ0xOLGtCQUFNSSxPQUREO0FBRUxGLG1CQUFPLEtBRkYsQ0FFUTtBQUZSLFNBckJEO0FBeUJSSyxrQkFBVTtBQUNOUCxrQkFBTUMsTUFEQTtBQUVOQyxtQkFBTztBQUZELFNBekJGO0FBNkJSTSxrQkFBVTtBQUNOUixrQkFBTUMsTUFEQTtBQUVOQyxtQkFBTztBQUZELFNBN0JGO0FBaUNSTyxzQkFBYztBQUNWVCxrQkFBTUMsTUFESTtBQUVWQyxtQkFBTztBQUZHLFNBakNOO0FBcUNSUSw4QkFBc0I7QUFDbEJWLGtCQUFNSSxPQURZO0FBRWxCRixtQkFBTztBQUZXLFNBckNkO0FBeUNSUyx3QkFBZ0I7QUFDWlgsa0JBQU0sQ0FBQ1ksTUFBRCxFQUFTWCxNQUFULENBRE07QUFFWkMsbUJBQU87QUFGSyxTQXpDUjtBQTZDUlcsdUJBQWU7QUFDWGIsa0JBQU0sQ0FBQ1ksTUFBRCxFQUFTWCxNQUFULENBREs7QUFFWEMsbUJBQU87QUFGSSxTQTdDUDtBQWlEUlksY0FBTTtBQUNGZCxrQkFBTUMsTUFESjtBQUVGQyxtQkFBTztBQUZMLFNBakRFO0FBcURSYSxxQkFBYTtBQUNUZixrQkFBTUMsTUFERztBQUVUQyxtQkFBTztBQUZFLFNBckRMO0FBeURSYywwQkFBa0I7QUFDZGhCLGtCQUFNQyxNQURRO0FBRWRDLG1CQUFPO0FBRk8sU0F6RFY7QUE2RFJlLHlCQUFpQjtBQUNiakIsa0JBQU1DLE1BRE87QUFFYkMsbUJBQU87QUFGTSxTQTdEVDtBQWlFUmdCLHdCQUFnQjtBQUNabEIsa0JBQU1DLE1BRE07QUFFWkMsbUJBQU87QUFGSyxTQWpFUjtBQXFFUmlCLHlCQUFpQjtBQUNibkIsa0JBQU1JLE9BRE87QUFFYkYsbUJBQU87QUFGTTs7QUFyRVQsSztBQTJFWmtCLFVBQU0sRTtBQUNOQyxhQUFTO0FBQ0xDLGdCQURLLG9CQUNJQyxLQURKLEVBQ1c7QUFDWixnQkFBSUMsU0FBU0QsTUFBTUMsTUFBbkI7QUFDQSxnQkFBSUMsU0FBUyxFQUFiO0FBQ0EsaUJBQUtDLFlBQUwsQ0FBa0IsUUFBbEIsRUFBNEJGLE1BQTVCLEVBQW9DQyxNQUFwQztBQUNILFNBTEk7QUFNTEUsZ0JBTkssb0JBTUlKLEtBTkosRUFNVztBQUNaLGdCQUFJQyxTQUFTRCxNQUFNQyxNQUFuQjtBQUNBLGdCQUFJQyxTQUFTLEVBQWI7QUFDQSxpQkFBS0MsWUFBTCxDQUFrQixLQUFsQixFQUF5QkYsTUFBekIsRUFBaUNDLE1BQWpDO0FBQ0gsU0FWSTtBQVdMRyxtQkFYSyx1QkFXT0wsS0FYUCxFQVdjO0FBQ2YsZ0JBQUlDLFNBQVNELE1BQU1DLE1BQW5CO0FBQ0EsZ0JBQUlDLFNBQVMsRUFBYjtBQUNBLGlCQUFLQyxZQUFMLENBQWtCLGFBQWxCLEVBQWlDRixNQUFqQyxFQUF5Q0MsTUFBekM7QUFDSCxTQWZJO0FBZ0JMSSxpQkFoQksscUJBZ0JLTixLQWhCTCxFQWdCWTtBQUNiLGdCQUFJQyxTQUFTRCxNQUFNQyxNQUFuQjtBQUNBLGdCQUFJQyxTQUFTLEVBQWI7QUFDQSxpQkFBS0MsWUFBTCxDQUFrQixTQUFsQixFQUE2QkYsTUFBN0IsRUFBcUNDLE1BQXJDO0FBQ0gsU0FwQkk7QUFxQkxLLHNCQXJCSywwQkFxQlVQLEtBckJWLEVBcUJpQjtBQUNsQixnQkFBSUMsU0FBU0QsTUFBTUMsTUFBbkI7QUFDQSxnQkFBSUMsU0FBUyxFQUFiO0FBQ0EsaUJBQUtDLFlBQUwsQ0FBa0IsZ0JBQWxCLEVBQW9DRixNQUFwQyxFQUE0Q0MsTUFBNUM7QUFDSCxTQXpCSTtBQTBCTE0sZUExQkssbUJBMEJHUixLQTFCSCxFQTBCVTtBQUNYLGdCQUFJQyxTQUFTRCxNQUFNQyxNQUFuQjtBQUNBLGdCQUFJQyxTQUFTLEVBQWI7QUFDQSxpQkFBS0MsWUFBTCxDQUFrQixRQUFsQixFQUE0QkYsTUFBNUIsRUFBb0NDLE1BQXBDO0FBQ0g7QUE5QkkiLCJmaWxlIjoiaW5kZXgud3hjIiwic291cmNlc0NvbnRlbnQiOlsiZXhwb3J0IGRlZmF1bHQge1xuICAgICAgICBjb25maWc6IHtcbiAgICAgICAgICAgIHVzaW5nQ29tcG9uZW50czoge31cbiAgICAgICAgfSxcbiAgICAgICAgYmVoYXZpb3JzOiBbXSxcbiAgICAgICAgcHJvcGVydGllczoge1xuICAgICAgICAgICAgc2l6ZToge1xuICAgICAgICAgICAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgICAgICAgICAgICB2YWx1ZTogXCJub3JtYWxcIiAvLyBub3JtYWwgc21hbGwgbGFyZ2VcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB0eXBlOiB7XG4gICAgICAgICAgICAgICAgdHlwZTogU3RyaW5nLFxuICAgICAgICAgICAgICAgIHZhbHVlOiAnJyAvL2JlYXV0eSBzZWxlY3Rpb24gc3VjY2VzcyBwcmltYXJ5IGRhbmdlciB3YXJuaW5nIHNlY29uZGFyeSBpbmZvIGRhcmsgZGlzYWJsZWQgIOaMiemSrueahOagt+W8j+exu+Wei1xuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHBsYWluOiB7XG4gICAgICAgICAgICAgICAgdHlwZTogQm9vbGVhbixcbiAgICAgICAgICAgICAgICB2YWx1ZTogZmFsc2UgLy8g5oyJ6ZKu5piv5ZCm6ZWC56m677yM6IOM5pmv6Imy6YCP5piOXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgdmFsdWU6IHtcbiAgICAgICAgICAgICAgICB0eXBlOiBTdHJpbmcsXG4gICAgICAgICAgICAgICAgdmFsdWU6IFwiXCJcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBob3ZlckNsYXNzOiB7XG4gICAgICAgICAgICAgICAgdHlwZTogU3RyaW5nLFxuICAgICAgICAgICAgICAgIHZhbHVlOiBcImJ0bl9faG92ZXJcIiAvLyBidG5fX2hvdmVyIG5vbmVcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBsb2FkaW5nOiB7XG4gICAgICAgICAgICAgICAgdHlwZTogQm9vbGVhbixcbiAgICAgICAgICAgICAgICB2YWx1ZTogZmFsc2UgLy8g5ZCN56ew5YmN5piv5ZCm5bimIGxvYWRpbmcg5Zu+5qCHXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgYnRuU3R5bGU6IHtcbiAgICAgICAgICAgICAgICB0eXBlOiBTdHJpbmcsXG4gICAgICAgICAgICAgICAgdmFsdWU6IFwiXCJcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBvcGVuVHlwZToge1xuICAgICAgICAgICAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgICAgICAgICAgICB2YWx1ZTogXCJcIlxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGFwcFBhcmFtZXRlcjoge1xuICAgICAgICAgICAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgICAgICAgICAgICB2YWx1ZTogXCJcIlxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGhvdmVyU3RvcFByb3BhZ2F0aW9uOiB7XG4gICAgICAgICAgICAgICAgdHlwZTogQm9vbGVhbixcbiAgICAgICAgICAgICAgICB2YWx1ZTogZmFsc2VcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBob3ZlclN0YXJ0VGltZToge1xuICAgICAgICAgICAgICAgIHR5cGU6IFtOdW1iZXIsIFN0cmluZ10sXG4gICAgICAgICAgICAgICAgdmFsdWU6IDIwXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgaG92ZXJTdGF5VGltZToge1xuICAgICAgICAgICAgICAgIHR5cGU6IFtOdW1iZXIsIFN0cmluZ10sXG4gICAgICAgICAgICAgICAgdmFsdWU6IDcwXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgbGFuZzoge1xuICAgICAgICAgICAgICAgIHR5cGU6IFN0cmluZyxcbiAgICAgICAgICAgICAgICB2YWx1ZTogXCJlblwiXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc2Vzc2lvbkZyb206IHtcbiAgICAgICAgICAgICAgICB0eXBlOiBTdHJpbmcsXG4gICAgICAgICAgICAgICAgdmFsdWU6IFwiXCJcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzZW5kTWVzc2FnZVRpdGxlOiB7XG4gICAgICAgICAgICAgICAgdHlwZTogU3RyaW5nLFxuICAgICAgICAgICAgICAgIHZhbHVlOiBcIlwiXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc2VuZE1lc3NhZ2VQYXRoOiB7XG4gICAgICAgICAgICAgICAgdHlwZTogU3RyaW5nLFxuICAgICAgICAgICAgICAgIHZhbHVlOiBcIlwiXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc2VuZE1lc3NhZ2VJbWc6IHtcbiAgICAgICAgICAgICAgICB0eXBlOiBTdHJpbmcsXG4gICAgICAgICAgICAgICAgdmFsdWU6IFwiXCJcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzaG93TWVzc2FnZUNhcmQ6IHtcbiAgICAgICAgICAgICAgICB0eXBlOiBCb29sZWFuLFxuICAgICAgICAgICAgICAgIHZhbHVlOiBmYWxzZVxuICAgICAgICAgICAgfVxuXG4gICAgICAgIH0sXG4gICAgICAgIGRhdGE6IHt9LFxuICAgICAgICBtZXRob2RzOiB7XG4gICAgICAgICAgICBvblN1Ym1pdChldmVudCkge1xuICAgICAgICAgICAgICAgIGxldCBkZXRhaWwgPSBldmVudC5kZXRhaWw7XG4gICAgICAgICAgICAgICAgbGV0IG9wdGlvbiA9IHt9O1xuICAgICAgICAgICAgICAgIHRoaXMudHJpZ2dlckV2ZW50KCdzdWJtaXQnLCBkZXRhaWwsIG9wdGlvbik7XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgYnRuQ2xpY2soZXZlbnQpIHtcbiAgICAgICAgICAgICAgICBsZXQgZGV0YWlsID0gZXZlbnQuZGV0YWlsO1xuICAgICAgICAgICAgICAgIGxldCBvcHRpb24gPSB7fTtcbiAgICAgICAgICAgICAgICB0aGlzLnRyaWdnZXJFdmVudCgndGFwJywgZGV0YWlsLCBvcHRpb24pO1xuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGdldFVzZXJJbmZvKGV2ZW50KSB7XG4gICAgICAgICAgICAgICAgbGV0IGRldGFpbCA9IGV2ZW50LmRldGFpbDtcbiAgICAgICAgICAgICAgICBsZXQgb3B0aW9uID0ge307XG4gICAgICAgICAgICAgICAgdGhpcy50cmlnZ2VyRXZlbnQoJ2dldHVzZXJpbmZvJywgZGV0YWlsLCBvcHRpb24pO1xuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIG9uQ29udGFjdChldmVudCkge1xuICAgICAgICAgICAgICAgIGxldCBkZXRhaWwgPSBldmVudC5kZXRhaWw7XG4gICAgICAgICAgICAgICAgbGV0IG9wdGlvbiA9IHt9O1xuICAgICAgICAgICAgICAgIHRoaXMudHJpZ2dlckV2ZW50KCdjb250YWN0JywgZGV0YWlsLCBvcHRpb24pO1xuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGdldFBob25lTnVtYmVyKGV2ZW50KSB7XG4gICAgICAgICAgICAgICAgbGV0IGRldGFpbCA9IGV2ZW50LmRldGFpbDtcbiAgICAgICAgICAgICAgICBsZXQgb3B0aW9uID0ge307XG4gICAgICAgICAgICAgICAgdGhpcy50cmlnZ2VyRXZlbnQoJ2dldHBob25lbnVtYmVyJywgZGV0YWlsLCBvcHRpb24pO1xuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIG9uRXJyb3IoZXZlbnQpIHtcbiAgICAgICAgICAgICAgICBsZXQgZGV0YWlsID0gZXZlbnQuZGV0YWlsO1xuICAgICAgICAgICAgICAgIGxldCBvcHRpb24gPSB7fTtcbiAgICAgICAgICAgICAgICB0aGlzLnRyaWdnZXJFdmVudCgnZXJycm9yJywgZGV0YWlsLCBvcHRpb24pO1xuICAgICAgICAgICAgfVxuICAgICAgICB9XG4gICAgfSJdfQ==