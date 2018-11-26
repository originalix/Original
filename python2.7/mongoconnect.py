#!/usr/bin/env python
# -*- coding=utf-8 -*-

MONGODB_HOST = 'localhost'
MONGODB_PORT = 27017
MONGODB_DBNAME = 'test'
MONGODB_TABLE = 'runoob'

import pymongo

host = MONGODB_HOST
port = MONGODB_PORT
dbname = MONGODB_DBNAME
client = pymongo.MongoClient(host=host, port=port)

# 定义数据库
db = client[dbname]
table = db[MONGODB_TABLE]

print client
print db
print table

table.remove({ 'name' : 'wsxxxxxx' })

dic = {
    'name': 'wsxxxxxx',
    'age': 26,
    'address': '北苑',
    'blog': 'star1201',
}

table.insert(dic)

def show(collection):
    # 查找
    for item in collection.find():
        print (item)

show(table)
