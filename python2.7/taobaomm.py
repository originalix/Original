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
import io

class TBMM:
    def getPage(self):
        url = 'https://mm.taobao.com/search_tstar_model.htm'
        driver = webdriver.PhantomJS()
        driver.get(url)
        time.sleep(5)
        with open('tbmm.html', 'w') as f:
            content = driver.page_source.encode('utf-8')
            f.write(content)
        driver.quit()

tbmm = TBMM()
tbmm.getPage()
