#!/usr/bin/env python
# -*- coding: utf-8 -*-
__author__ = 'Lix'

from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time
import re
import requests
import os

class TBMM:
    def __init__(self):
        """淘女郎爬虫类初始化函数
        """

        self.site_url = 'https://mm.taobao.com/search_tstar_model.htm'
        self.driver = webdriver.Chrome()
        self.sleep_time = 1
        self.save_img_path = '/Users/Lix/Documents/www/htdocs/origin/tbmm/'

    def getPage(self):
        """获取淘女郎页面HTML内容
        
        Returns:
            <soup> -- <BeautifulSoup库解析的html数据>
        """

        self.driver.get(self.site_url)
        time.sleep(self.sleep_time)
        content = self.driver.page_source.encode('utf-8')
        print self.driver.title
        soup = BeautifulSoup(content, 'html.parser')
        return soup
    
    def getContent(self, soup):
        """ 获取淘女郎中，列表的数据，
            包括封面图，姓名，城市，身高体重
        
        Arguments:
            soup {bp4库解析出的默认格式} -- [html数据]
        """

        items = soup.find_all(class_='item')
        for item in items:
            # print item
            print u'----分割线---'
            page_code = str(item)
            name = item.find(class_='name').text
            city = item.find(class_='city').text
            img = ''
            link = 'http:' + item.a['href']
            pattern = re.compile(r'data-ks-lazyload="(.*?)"', re.S)
            result = re.search(pattern, page_code)
            # 解析封面图URL
            if result:
                img = 'http:' + result.group(1).strip()
            else:
                # 若不是懒加载的图片 提取img的src属性当做url
                if item.img['src'] is not None:
                    img = 'http:' + item.img['src']
                else:    
                    pass
            # 正则匹配身高体重
            pattern = re.compile(r'<span>(.*?)</span>', re.S)
            result = re.search(pattern, page_code)
            # 去除身高体重里的斜线符号
            if result:
                height_wight = result.group(1).strip()
                height_wight = height_wight.replace('/', '-')
            else:
                print u'身高体重未找到'
            # print name
            # print city
            # print img
            # print height_wight
            # print link
            img_dir_path = self.save_img_path + name.encode('utf-8') + '-' + height_wight
            self.mkdir(img_dir_path)
            self.saveImg(img_dir_path, img, name)
            self.go2ContentPage(link, img_dir_path)
            print '----------------------------------'
            break
    
    def saveImg(self, savePath, imageURL, fileName):
        """存储图片方法
        
        Arguments:
            imageURL <string> -- 图片的url
            fileName <string> -- 用于存储的文件名
        """
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
        else:
            print path + ' 目录已存在'
        
        return True

    def go2ContentPage(self, url, save_url):
        self.driver.get(url)
        content = self.driver.page_source.encode('utf-8')
        soup = BeautifulSoup(content, 'html.parser')
        aixiucontent = soup.find(id="J_ScaleImg")
        allImgs = aixiucontent.find_all('img')
        print allImgs
        index = 0;
        for img in allImgs:
            index += 1
            imgurl = 'http:' + img['src']
            self.saveImg(save_url, imgurl, str(index))
            print imgurl

    def start(self):
        """ 淘女郎爬虫类执行函数0p-oo
        """

        soup = self.getPage()
        self.getContent(soup)

tbmm = TBMM()
tbmm.start()
