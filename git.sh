git diff
echo "请查看本次提交差异\n";
echo "确认提交请输入commit信息\n";
echo "如需要取消本次提交，请按ctrl+c";
read commitString


if [ "$commitString" =  "" ]
then
   echo "请不要包含换行符，请重新输入commit信息\n";
   read commitString
else
    git add .
    git commit -m "[$commitString]"
    git push -u origin
fi
