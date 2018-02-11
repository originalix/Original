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
