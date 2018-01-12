#!/usr/bin/env python
# -*- coding: utf-8 -*-

import requests

# Requests库 使用练习
def practice_requests():
    r = requests.get('http://httpbin.org/ip')
    data = {'data' : 'lix'}
    r = requests.post('http://httpbin.org/post', data = data)
    print r.status_code
    print r.headers['content-type']
    print r.encoding
    print r.text
    print r.json()

if __name__ == '__main__':
    practice_requests()
