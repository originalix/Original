#!/bin/bash
#author: Lix

echo "请输入本次commit信息:";
read commitString
git add .
git commit -m "[$commitString]"
git push -u origin
git push -u os

