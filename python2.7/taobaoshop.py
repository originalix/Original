#!/usr/bin/env python
# -*- coding=utf-8 -*-

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

class taobaoShop:
    def __init__(self):
        """初始化构造函数
        """

        # self.site_url = 'https://elcjstyle.taobao.com/search.htm?spm=a1z10.1-c-s.0.0.68616fccLXsimv&search=y'
        self.site_url = 'https://elcjstyle.taobao.com/search.htm?spm=a1z10.3-c-s.w4002-14473867114.112.73264e25rQGjKe&_ksTS=1519215108692_208&callback=jsonp209&mid=w-14473867114-0&wid=14473867114&path=%2Fsearch.htm&search=y&pageNo=4#anchor'
        self.driver = webdriver.Chrome()
        self.sleep_time = 1
        self.save_img_path = '/Users/Lix/Documents/www/htdocs/origin/tbmm/'
        self.total_page = 1
        self.current_page = 1

    def getPage(self):
        """获取淘宝店铺页面代码
        """

        self.driver.get(self.site_url)
        time.sleep(self.sleep_time)
        content = self.driver.page_source.encode('utf-8')
        print self.driver.title
        
        self.saveHtml('taobaoshop', content)
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
                link = item.xpath("./dt/a/@href")[0]
                photo = item.xpath("./dt/a/img/@src")[0]
                res = {
                    'link' : link,
                    'photo' : photo
                }
                print res
        
        # 获取分页信息
        pagination = selector.xpath("//div[@class='pagination']/a[contains(@class, 'J_SearchAsync') and contains(@class, 'next')]/@href")
        print pagination
        if len(pagination) == 0:
            print '没有下一页了'
        else:
            print '加载下一页内容'
    

def main():
    tb = taobaoShop()
    tb.getPage()

if __name__ == "__main__":
    main()
