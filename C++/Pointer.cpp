#include <iostream>

using namespace std;

void testPointerValue()
{
    int var = 20;
    int *ip;

    ip = &var;

    cout << "Value of var variable: ";
    cout << var << endl;

    //输出在指针变量中存储的地址
    cout << "Address stored in ip variable: ";
    cout << ip << endl;

    cout << "Value of *ip variable: ";
    cout << *ip << endl;
}

void NullPointer()
{
    int *ptr = NULL;

    cout << "ptr 的值是 " << ptr << endl;
}

int main()
{

    testPointerValue();

    NullPointer();

    cout << "Hello wsx" << endl;
    return 0;
}