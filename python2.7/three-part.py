#!/usr/bin/env python
# -*- coding: utf-8 -*-

import requests
from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

def practice_requests():
    """Requests 练习
    """

    r = requests.get('http://httpbin.org/ip')
    data = {'data' : 'lix'}
    r = requests.post('http://httpbin.org/post', data = data)
    print r.status_code
    print r.headers['content-type']
    print r.encoding
    print r.text
    print r.json()

def practice_beautiful_soup():
    """BeautifulSoup4 练习
    """

    html_doc = """
    <html><head><title>The Dormouse's story</title></head>
    <body>
    <p class="title"><b>The Dormouse's story</b></p>

    <p class="story">Once upon a time there were three little sisters; and their names were
    <a href="http://example.com/elsie" class="sister" id="link1">Elsie</a>,
    <a href="http://example.com/lacie" class="sister" id="link2">Lacie</a> and
    <a href="http://example.com/tillie" class="sister" id="link3">Tillie</a>;
    and they lived at the bottom of a well.</p>

    <p class="story">...</p>
    """
    soup = BeautifulSoup(html_doc, 'html.parser')
    print soup.prettify()
    print soup.title
    print soup.title.name
    print soup.title.string
    print soup.p['class']
    print soup.find_all('a')
    print soup.find(id='link3')
    for link in soup.find_all('a'):
        print link.get('href')
    print soup.get_text()

def practice_beautiful_soup_tag():
    """针对BeautifulSoup4文档的对象的种类
    """

    soup = BeautifulSoup('<b class="boldest">Extremely bold</b>', "lxml")
    tag = soup.b
    print type(tag)
    print tag.name
    tag.name = 'blockquote'
    print tag
    print tag.attrs
    tag['class'] = 'verygood'
    tag['id'] = 1
    print tag.get('class')

    css_soup = BeautifulSoup('<p class="body strikeout"></p>', 'lxml')
    print css_soup.p['class']
    css_soup.p['class'] = ['wsx', 'lix']
    print css_soup

def practice_selenium():
    driver = webdriver.Chrome()
    driver.get("https://www.baidu.com/")
    title = u'百度'
    assert title in driver.title
    elem = driver.find_element_by_name("wd")
    elem.clear()
    elem.send_keys("pycon")
    elem.send_keys(Keys.RETURN)
    assert "No results found." not in driver.page_source
    driver.close()

def practice_taobaomm():
    driver = webdriver.Chrome()
    driver.get("https://mm.taobao.com/search_tstar_model.htm?spm=5679.126488.640745.2.45914c54V0T6ut")
    try:
        element = WebDriverWait(driver, 10).until(
            EC.presence_of_element_located((By.CLASS_NAME, "item-wrap"))
        )
    finally:
        driver.save_screenshot('screenshot.png')
        driver.quit()

if __name__ == '__main__':
    # practice_requests()
    # practice_beautiful_soup()
    # practice_beautiful_soup_tag()
    # practice_selenium()
    practice_taobaomm()