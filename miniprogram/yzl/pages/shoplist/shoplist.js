var config = require('../../config.js');
const Dialog = require('../../bower_components/zanui-weapp/dist/dialog/dialog');

var appInstance = getApp()

Page({
  data: {
    tabs: [

    ],
		defaultIndex: 0,
    productList: [],
    cartShow: false,
		cartMin: 0,
		cartMax: 99999,
		cartOrigin: 1,
		cartList: [],
		cartCount: 0,
		price: 0.00,
  },
  onLoad(option) {
		console.log('option query is : ')
		console.log(option.id)
		const categoryId = option.id
		this.getTab(categoryId)
  },
  getTab(categoryId) {
		const that = this
		var defaultIdx = 0
		wx.request({
			url: config.service.getCategoryListUrl,
			header: appInstance.requestToken,
			success: function (res) {
				console.log(res.data)
				const categories = res.data.data
				console.log(categories)
				let tlist = []
				for (var i=0; i<categories.length; i++) {
					console.log(categories[i])
					if (categoryId == categories[i].id) {
						defaultIdx = i
					}
					tlist.push(
						{'id': categories[i].id, 'title': categories[i].category}
					)
				}
				console.log('tlist: ')
				console.log(tlist)
				console.log('defaultIdx: ' + defaultIdx)
				console.log('categoryId: ' + categoryId)
				that.setData({
					tabs: tlist,
					defaultIndex: defaultIdx
				}, function() {})
			}
		})
  },
	/**
	 * 商品列表的点击事件，增加badeg数量 并且加入购物车
	 */
  addBadge: function (event) {
    var item = event.currentTarget.dataset.item
		console.log('addbadge')
		console.log(item)

		if (item.customOption.length > 0) {
			this.selectCustomOption(item)
			return
		}

		this.refreshProductItemBadge(item, item.badge + 1)
    this.addCartItem(item)
  },
  /**
   * 点击带customOption属性商品的点击事件
   * @param {*} item 
   */
	selectCustomOption (item) {
			console.log('存在可选值')
			var btnList = []
			for (var i=0; i<item.customOption.length; i++) {
				var btnItem = {
					text: item.customOption[i].custom_option_key,
					type: item.customOption[i].id
				}
				btnList.push(btnItem)
			}
			console.log(btnList)

			Dialog({
				message: '请选择商品具体类型',
				title: '温馨提醒',
				selector: '#zan-dialog-tip',
				buttons: btnList,
				buttonsShowVertical: true,
			}).then(({ type }) => {
				console.log('=== dialog with custom buttons ===', `type: ${type}`)
				item.selectCustomId = type
				console.log('=== now item is')
				console.log(item)
				this.refreshProductItemBadge(item, item.badge + 1)
    		this.addCartItem(item)
			})
	},
	/*
	 * 添加商品进入购物车
	 */
	addCartItem: function (item) {
		console.log('add cart item')
    console.log(item)
    let customOption = this.getCustomOptionByItem(item)
    if (customOption !== null) {
      item = this.refreshItemByCustomOption(item, customOption)
    }
		var that = this
		var list = that.data.cartList
		const res = this.isInCartList(item)
		console.log(res)
		// 判断已经添加过商品
		if (res.exist === true) {
			// 产品badge +1 并更新购物车数组中单个item
      // list[res.idx].badge = item.badge
      list[res.idx].badge = res.sameOption + 1
			var targetItem = "cartList[" + res.idx + " ]"
			that.setData({
				targetItem: list[res.idx]
			})
			console.log('now cart list is : ')
			console.log(list[res.idx])
		} else {
      // 如果之前已经有相同类型产品 那么使用sameOption值来确定购物车内badge值
      if (res.sameItem > 0) {
        item.badge = res.sameOption + 1
      }
      // 添加产品进入list
			list.push(item)
			that.setData({
				cartList: list
			}, function () {})
		}
		// 刷新cartlist
		this.calculateCartCount()
  },
  /**
   * 判断购物车内是否已经存在该商品
   * @param {*} item 
   */
	isInCartList(item) {
		var that = this;
		let res = {'exist': false, 'idx': -1, 'sameItem': 0, 'sameOption': 0}
		for (var i=0; i<that.data.cartList.length; i++) {
			var exitsItem = that.data.cartList[i]
			if (item.id === exitsItem.id) {
        res.sameItem += exitsItem.badge
				// 当自定义属性相同时， 才判定为同种商品
				if (item.selectCustomId === exitsItem.selectCustomId) {
					// res = {'exist': true, 'idx': i}
          res.exist = true
          res.idx = i
          res.sameOption += exitsItem.badge
          return res
				}
			}
		}
		return res
  },
  getCustomOptionByItem (item) {
    if (item.selectCustomId === null) {
      return null
    }

    let customObj = null
    for (var i=0; i<item.customOption.length; i++) {
      let obj = item.customOption[i]
      if (obj.id === item.selectCustomId) {
        customObj = obj
        break
      }
    }
    console.log(`=========>>>>>> custom Obj is : `)
    console.log(customObj)
    return customObj
  },
  refreshItemByCustomOption (item, customOption) {
    // item.title = `${item.title} ${customOption.custom_option_key}`
    // item.price = customOption.price
    item.selectCustom = customOption
    return item
  },
	/**
	 * tab的点击事件，刷新列表，重新从接口请求商品数据
	 */
  onClick: function(e) {
    console.log(`ComponentId:${e.detail.componentId},you selected:${e.detail.key}`);
		const categoryId = this.data.tabs[`${e.detail.key}`].id
		console.log('categoryId IS : ' + categoryId)
		var that = this
		wx.request({
			url: config.service.getProductByCategoryId,
			header: appInstance.requestToken,
			data: {
				'id': categoryId
			},
			success: function (res) {
				console.log(res.data)
				const items = res.data.data.items
				let product_li = []
				for (var i=0; i<items.length; i++) {
					const product = items[i].product
					console.log(product)
					const productInfo = {
						'id': product.id,
						'image': product.image[0],
						'title': product.name,
						'price': product.price,
						'badge': that.checkBadgeInCartList(product.id),
						'customOption': product.customOptionStock,
            'selectCustomId': null,
            'selectCustom': null
					}
					product_li.push(productInfo)
				}
				console.log(product_li);
				that.setData({
					'productList': product_li,
				}, function () {})
			}
		})
	},
	/**
	 *  加载商品列表时，同步badge
	 */
	checkBadgeInCartList(id) {
		const cartList = this.data.cartList

		for (var i=0; i<cartList.length; i++) {
			if (cartList[i].id === id) {
				return cartList[i].badge
			}
		}
		return 0
	},
	/**
	 * 打开关闭购物车菜单
	 */
  showPopup (e) {
    console.log(e)
    let cartState = e.target.dataset.cartshow
    this.setData({
      cartShow: !cartState
    }, function () {})
  },
	/*
	 *  购物车 counter组件的点击事件
	 */
  onChangeNumber (e) {
		const currentNum = e.detail.number
		const cartIdx = e.target.dataset.idx
		const currentItem = e.target.dataset.item
		console.log('current number is : ' + currentNum)
		console.log('current Idx is : ' + cartIdx)
    console.log(e)
		this.refreshCartItemBadge(cartIdx, currentNum)
		this.refreshProductItemBadge(currentItem, currentNum)
		this.calculateCartCount()
  },
	/*
	*		传入一个产品，更新他的badge值
	*/
	refreshProductItemBadge(item, value) {
		const that = this
		const productList = that.data.productList

		// 根据productid 查找到对应productList里的index
		for (var i=0; i<productList.length; i++) {
			if (item.id === productList[i].id) {
				// i is index
				var targetItem = "productList[" + i + "]"
				item.badge = value

				that.setData({
					[targetItem]: item
				}, function () {})
			}
		}
	},
	/*
	 * 传入购物车的列表index，刷新购物车item的badge值
	 */
	refreshCartItemBadge(idx, value) {
		var that = this
		var list = that.data.cartList
		if (value != 0) {
			list[idx].badge = value
			var targetItem = "cartList[" + idx + " ]"
			that.setData({
				targetItem: list[idx]
			})
			console.log('now refresh cart list is : ')
			console.log(list[idx])
			return
		} else {
			list.splice(idx, 1)
			that.setData({
				cartList: list
			}, function () {})
			return
		}
	},
	/**
	 * 在添加完商品后，计算购物车内所有商品数量，并刷新左下角badge
	 */
	calculateCartCount() {
		const list = this.data.cartList
		console.log('list ---->: ')
		console.log(list)
		let sum = 0
		let sumPrice = 0.00
		for (let i=0; i<list.length; i++) {
      sum += list[i].badge
      if (list[i].selectCustom !== null) {
        sumPrice += Number(list[i].selectCustom.price) * list[i].badge
      } else {
			  sumPrice += Number(list[i].price) * list[i].badge
      }
		}
		console.log('cartsum : ' + sum)
		console.log('price: ' + sumPrice.toFixed(2))
		this.setData({
			'cartCount': sum,
			'price': sumPrice.toFixed(2)
		}, function () {})
	},
	/*
	 *  清理购物车列表，清空按钮的点击事件
	 */
	clearCartList() {
		var that = this
		Dialog({
			title: '操作提示',
			message: '确认清空选项吗？',
			selector: '#zan-dialog-tip',
			showCancelButton: true,
			confirmButtonColor: '#00dbf5',
			cancelButtonColor: '#00dbf5',
		}).then((res) => {
			if (res.type === "confirm") {
				const list = that.data.cartList
				for (var i=0; i<list.length; i++) {
					that.refreshProductItemBadge(list[i], 0)
				}
				that.setData({
					'cartList': []
				}, function() {
					that.calculateCartCount()
				})
			}
		})
	},
	/* 保存购物车的数据，传值到下个场景 */
	saveCartParams() {
		const that = this
		try {
			wx.setStorageSync('CART_LIST_DATA', that.data.cartList)
		} catch (e) {
			console.log(e)
		}
	},
	pushToCreateOrderPage() {
		this.saveCartParams()
		wx.navigateTo({
			url: '/pages/createOrder/createOrder'
		})
	}
})
