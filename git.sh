 git diff
 echo "请查看本次提交差异"
 echo "确认提交请输入commit信息"
 echo "如需要取消本次提交，请按ctrl+c"
 read -p "Enter commit message: " commitString
 
 
 if [ "$commitString" =  "" ]
 then
     echo "请不要包含换行符，请重新输入commit信息"
     read commitString
 else
     echo "$commitString" 
     git add .
     git commit -m "[$commitString]"
     git push -u origin
     git push -u os
 fi
