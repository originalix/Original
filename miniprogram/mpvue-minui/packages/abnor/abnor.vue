<template>
  <div class="lix-abnor">
    <div class="lix-abnor__box">
      <image class="lix-abnor__image" v-if="image" :src="image" mode="widthFix"/>
      <div class="lix-abnor__text" v-if="title">{{ title }}</div>
      <div class="lix-abnor__tip" v-if="tip">{{ tip }}</div>
      <div class="lix-abnor__btn" v-if="button" @click="emitAbnorTap">{{ button }}</div>
    </div>
  </div>
</template>

<script>
import Types from './config';
export default {
  props: {
    type: {
      type: String,
      default: ''
    },
    image: {
      type: String,
      default: ''
    },
    title: {
      type: String,
      default: ''
    },
    tip: {
      type: String,
      default: ''
    },
    button: {
      type: String,
      default: ''
    }
  },
  data: {},
  created() {
    console.log('Now-type is : ', this.type);
    const type = this.type;
    if (type && Types[type]) {
      this.image = this.image || Types[type].image;
      this.title = this.title || Types[type].title;
      this.button = this.button || Types[type].button;
      this.tip = this.tip || Types[type].tip;
    }
  },
  methods: {
    emitAbnorTap(event) {
      let detail = event.detail;
      let option = {};
      this.$emit('abnortap', detail, option);
    }
  }
};
</script>

<style lang="scss">
@import "../../theme-chalk/mixins/mixins";
@import "../../theme-chalk/common/var";
@import "../../theme-chalk/_main.scss";

@include b(abnor) {
  position: relative;
  display: block;
  width: 100%;
  height: 0;
  padding-bottom: 100%;
  overflow: hidden;

  @include e(box) {
    position: absolute;
    display: flex;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  @include e(image) {
    width: 514rpx;
    background: transparent no-repeat;
    background-size: cover;
  }

  @include e(btn) {
    min-width: 228rpx;
    height: 66rpx;
    margin-top: 30rpx;
    padding: 0 30rpx;
    background-color: #ff5777;
    border: 0 none;
    border-radius: 2px;
    color: #fff;
    font-size: 28rpx;
    text-align: center;
    overflow: hidden;
    line-height: 66rpx;
  }

  // @include e(btn:active) {
  //   background-color: #f5456e;
  // }

  @include e(text) {
    margin-top: 30rpx;
    color: #333;
    font-size: 28rpx;
  }

  @include e(tip) {
    margin-top: 20rpx;
    color: #666;
    font-size: 24rpx;
  }
}
</style>
