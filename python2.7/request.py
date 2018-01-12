#!/usr/bin/env python
# -*- coding: utf-8 -*-

import requests

r = requests.get('http://httpbin.org/ip')
print r.status_code
print r.headers['content-type']
print r.encoding
print r.text
print r.json()
