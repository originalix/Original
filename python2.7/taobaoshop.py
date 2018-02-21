#!/usr/bin/env python
# -*- coding: utf-8 -*-

__author__ = 'Lix'

# from bs4 import BeautifulSoup
from lxml import etree
from selenium import webdriver
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.common.by import By
import time
import re
import requests
import os
import sys

sys_encoding = sys.getfilesystemencoding()
def printcn(msg):
    print(msg.decode('utf-8').encode(sys_encoding))


class taobaoShop:
    def __init__(self):
        """初始化构造函数
        """

        self.site_url = 'https://elcjstyle.taobao.com/search.htm?spm=a1z10.1-c-s.0.0.68616fccLXsimv&search=y'
        # self.site_url = 'https://elcjstyle.taobao.com/search.htm?spm=a1z10.3-c-s.w4002-14473867114.112.73264e25rQGjKe&_ksTS=1519215108692_208&callback=jsonp209&mid=w-14473867114-0&wid=14473867114&path=%2Fsearch.htm&search=y&pageNo=4#anchor'
        self.driver = webdriver.Chrome()
        self.sleep_time = 3
        self.save_img_path = '/Users/Lix/Documents/tbshop/'
        self.total_page = 1
        self.current_page = 1

    def getPage(self):
        """获取淘宝店铺页面代码
        """

        self.driver.get(self.site_url)
        time.sleep(self.sleep_time)
        content = self.driver.page_source.encode('utf-8')
        print self.driver.title
        
        # self.saveHtml('taobaoshop', content)
        self.getItem()

    def saveHtml(self, file_name, file_content):  
        #    注意windows文件命名的禁用符，比如 /  
        with open(file_name.replace('/', '_') + ".html", "wb") as f:
            #   写文件用bytes而不是str，所以要转码  
            f.write(file_content)
    
    def getItem(self):
        """爬取当前页面的每个宝贝，
           提取宝贝名字，价格，标题等信息
        """

        html = self.driver.page_source.encode('utf-8')
        selector = etree.HTML(html)
        itemList = selector.xpath("//div[@class='item3line1']")
        
        # 循环遍历该页所有商品
        for item3line1 in itemList:
            dl = item3line1.xpath("./dl")
            for item in dl:
                link = 'https:' + item.xpath("./dt/a/@href")[0]
                photo = 'https:' + item.xpath("./dt/a/img/@src")[0]
                title = item.xpath("./dd/a/text()")[0]
        
                res = {
                    'link' : link,
                    'photo' : photo,
                    'title' : title
                }

                # print res

                # 进入宝贝详情页 开始爬取里面的图片资料
                self.getItemDetail(link, '')
                # time.sleep(7)
        
        # # 获取分页信息
        # pagination = selector.xpath("//div[@class='pagination']/a[contains(@class, 'J_SearchAsync') and contains(@class, 'next')]/@href")
        # print pagination
        # if len(pagination) == 0:
        #     print '没有下一页了'
        # else:
        #     print '加载下一页内容'
        #     self.site_url = 'https:' + pagination[0]
        #     print self.site_url
        #     self.getPage()

    def getItemDetail(self, link, save_img_path):
        """从宝贝的详情链接里 爬取图片
        
        Arguments:
            link {String} -- [宝贝详情链接]
        """
        newDriver = webdriver.Chrome()
        newDriver.get(link)
        time.sleep(self.sleep_time)

        print newDriver.title

        img_dir_path = self.save_img_path + newDriver.title.encode('utf-8')
        if True == self.mkdir(img_dir_path):
            # self.saveImg(img_dir_path, photo, title)
            print '创建目录成功'

        html = newDriver.page_source.encode('utf-8')
        selector = etree.HTML(html)

        # 封面图
        J_ULThumb = selector.xpath("//div[@class='tb-gallery']/ul/li")
        index = 0
        for li in J_ULThumb:
            # 替换图片 从50*50 至 400 * 400
            small_pic = li.xpath("./div/a/img/@data-src")[0]
            common_pic = 'https:' + small_pic.replace('50x50', '400x400')
            print common_pic
            thumb_title = str('封面图') + str(index)
            print type(thumb_title)
            print thumb_title
            self.saveImg(img_dir_path, common_pic, thumb_title.decode('utf-8'))
            index += 1

        # 爬取里面所有图片
        sub_wrap = selector.xpath("//div[@class='sub-wrap']")[0]
        all_img = sub_wrap.xpath("//img/@src")
        
        index = 0
        for img in all_img:
            imglink = img
            if img.startswith('http') is True:
                imglink = img
            else:
                imglink = 'https:' + img

            self.saveImg(img_dir_path, imglink, str(index))
            index += 1

        newDriver.quit()

    def saveImg(self, savePath, imageURL, fileName):
        """存储图片方法
        
        Arguments:
            imageURL <string> -- 图片的url
            fileName <string> -- 用于存储的文件名
        """
        print '开始保存图片' + fileName.encode('utf-8')
        with open(savePath + '/' + fileName.encode('utf-8') + '.png', 'wb') as f:
            f.write(requests.get(imageURL).content)

    def mkdir(self, path):
        """创建文件夹
        
        Arguments:
            path <String> -- 需要创建的文件夹路径
        
        Returns:
            <Bool> -- 是否创建成功
        """

        # 去除路径首尾空格
        path = path.strip()
        path = path.rstrip('\\')
        isExists = os.path.exists(path)

        if not isExists:
            print path + ' 创建成功'
            os.makedirs(path)
            return True
        else:
            print path + ' 目录已存在'
            return False

def main():
    tb = taobaoShop()
    tb.getPage()

if __name__ == "__main__":
    main()
