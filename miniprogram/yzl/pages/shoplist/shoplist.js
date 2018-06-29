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
			console.log('存在可选值')
			var btnList = []
			for (var i=0; i<item.customOption.length; i++) {
				var btnItem = {
					'text': item.customOption.custom_option_key,
					'type': item.customOption.id
				}
				btnList.push(btnItem)	
			}

			Dialog({
				message: '请选择商品具体类型',
				title: '温馨提醒',
				selector: '#zan-dialog-tip',
				buttons: btnList,
			}).then(({ type }) => {
				console.log('=== dialog with custom buttons ===', `type: ${type}`)
			})

			return
		}

		this.refreshProductItemBadge(item, item.badge + 1)
    this.addCartItem(item)
  },
	/*
	 * 添加商品进入购物车
	 */
	addCartItem: function (item) {
		console.log('add cart item')
		console.log(item)
		var that = this
		var list = that.data.cartList	
		const res = this.isInCartList(item)
		console.log(res)
		// 判断已经添加过商品
		if (res.exist === true) {
			// 产品badge +1 并更新购物车数组中单个item
			list[res.idx].badge = item.badge
			var targetItem = "cartList[" + res.idx + " ]"
			that.setData({
				targetItem: list[res.idx] 
			})
			console.log('now cart list is : ')
			console.log(list[res.idx])
		} else {
			// 添加产品进入list
			list.push(item)			
			that.setData({
				cartList: list
			}, function () {})
		}
		// 刷新cartlist
		this.calculateCartCount()
	},
	isInCartList(item) {
		var that = this;
		let res = {'exist': false, 'idx': -1}
		for (var i=0; i<that.data.cartList.length; i++) {
			if (item.id === that.data.cartList[i].id) {
				res = {'exist': true, 'idx': i}
				return res
			}
		}
		return res
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
						'customOption': product.customOptionStock
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
			sumPrice += Number(list[i].price) * list[i].badge
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
