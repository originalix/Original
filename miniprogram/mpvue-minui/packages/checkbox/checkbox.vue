<template>
  <div class="checkbox-class zan-checkbox" :class="[isInGroup ? 'zan-checkbox__item' : '', type === 'list' ? 'zan-checkbox__list-item' : '']"
    @click="handleClick">

    <div class="zan-checkbox__icon"
      :class="[disabled ? 'zan-checkbox--disabled' : '', checked? 'zan-checkbox--checked' : '', checked ? 'zan-icon-checked' : 'zan-icon-check', 'zan-icon']"
    >
    </div>
    <div class="zan-checkbox__label">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    checked: {
      type: Boolean,
      default: false
    },
    disabled: {
      type: Boolean,
      default: false
    },
    isInGroup: {
      type: Boolean,
      default: false
    },
    labelDisabled: {
      type: Boolean,
      default: true
    },
    type: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      isInCell: false
    };
  },
  methods: {
    handleClick(e) {
      console.log('hello world');
      if (this.disabled) {
        return;
      }
      const checked = !this.checked;
      this.$emit('change', checked);
      this.checked = checked;
    },
    updateData(data) {
      this.setData(data);
    }
  }
};
</script>

<style lang="scss">
  .zan-checkbox {
    display: inline-block;
    padding: 0;
    padding-left: 10px;
    font-size: 20px
  }

  .zan-checkbox__item {
    display: block;
    margin-top: 10px
  }

  .zan-checkbox__list-item {
    display: block;
    padding: 10px 10px 10px 0;
    margin-left: 10px;
    border-bottom: 1px solid #e5e5e5
  }

  .zan-checkbox__list-item .zan-checkbox__icon {
    float: right
  }

  .zan-checkbox__icon {
    display: -webkit-inline-box;
    display: inline-flex;
    -webkit-box-align: center;
    align-items: center;
    color: #aaa
  }

  .zan-checkbox__icon.zan-checkbox--checked {
    color: #f56600
  }

  .zan-checkbox__icon.zan-checkbox--disabled {
    color: #e5e5e5
  }

  .zan-checkbox__label {
    display: inline-block;
    margin-left: 8px
  }
</style>