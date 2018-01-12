#!/usr/bin/env python
# -*- coding: utf-8 -*-

import requests
from bs4 import BeautifulSoup

def practice_requests():
    r = requests.get('http://httpbin.org/ip')
    data = {'data' : 'lix'}
    r = requests.post('http://httpbin.org/post', data = data)
    print r.status_code
    print r.headers['content-type']
    print r.encoding
    print r.text
    print r.json()

def practice_beautiful_soup():
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
    # print soup.prettify()
    # print soup.title
    # print soup.title.name
    # print soup.title.string
    # print soup.p['class']
    # print soup.find_all('a')
    # print soup.find(id='link3')
    # for link in soup.find_all('a'):
    #     print link.get('href')
    print soup.get_text()



if __name__ == '__main__':
    # practice_requests()
    practice_beautiful_soup()