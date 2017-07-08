#include <iostream>
#include <cstdlib>
#include <ctime>
using namespace std;

#include <iomanip>
using std::setw;

double getAverage(int arr[], int size);

void BinaryCalculate(void)
{
    unsigned int a = 30;
    unsigned int b = 11;
    int c = 0;

    c = a & b;
    cout << "Line 1 - C 的值是 " << c << endl;

    c = a | b;
    cout << "Line 2 - C 的值是 " << c << endl;

    c = a ^ b;
    cout << "Line 3 - C 的值是 " << c << endl;

    c = ~a;
    cout << "Line 4 - C 的值是 " << c << endl;

    c = ~b;
    cout << "Line 5 - C 的值是 " << c << endl;

    c = a << 2;
    cout << "Line 6 - C 的值是 " << c << endl;

    c = b >> 2;
    cout << "Line 7 - C 的值是 " << c << endl;
}

// void swap(int *x, int *y)
// {
//     int temp;

//     temp = *x;
//     *x = *y;
//     *y = temp;

//     return;
// }

void swap(int &x, int &y)
{
    int temp;

    temp = x;
    x = y;
    y = temp;

    return;
}

void printArray()
{
    int n[10];
    for (int i = 0; i < 10; i++)
    {
        n[i] = i + 100;
    }
    cout << "Element" << setw(13) << "Value" << endl;

    for (int j = 0; j < 10; j++)
    {
        cout << setw(7) << j << setw(13) << n[j] << endl;
    }
}

void MoreDimensionArray()
{
    int a[3][4] = {
        {0, 1, 2, 3},
        {4, 5, 6, 7},
        {8, 9, 10, 11}
    };

    for (int i = 0; i < 3; i++)
    {
        for (int j = 0; j < 4; j++)
        {
            cout << "a[" << i << "][" << j << "] = ";
            cout << a[i][j] << endl;
        }
    }
}

void PointerArray()
{
    double balance[5] = {1000.0, 1024.0, 2048.0, 21.0, 1201.0};
    double *p;
    p = balance;

    cout << "使用指针的数组值" << endl;
    for (int i = 0; i < 5; i++)
    {
        cout << "*(p + " << i << ") = ";
        cout << *(p + i) << endl;
    }

    cout << "使用 balance 作为地址的数组值" << endl;
    for (int i = 0; i < 5; i++)
    {
        cout << "*(balance + " << i << ") = ";
        cout << *(balance + i) << endl;
    }
}

double getAverage(int arr[], int size)
{
    int i, sum = 0;
    double avg;

    for (i = 0; i < size; i++)
    {
        sum += arr[i];
    }

    avg = double(sum) / size;

    return avg;
}

int * getRandom()
{
    static int r[10];

    srand( (unsigned)time( NULL ) );
    for (int i = 0; i < 10; i++)
    {
        r[i] = rand();
        cout << r[i] <<endl;
    }

    return r;
}

void charString()
{
    char greeting[6] = {'H', 'e', 'l', 'l', 'o', '\0'};
    cout << "Greeting message: ";
    cout << greeting << endl;

    char str1[11] = "Hello";
    char str2[11] = "World";
    char str3[11];
    int len;

    cout << "Str1 = " << str1 << endl;
    cout << "Str2 = " << str2 << endl;
    cout << "Str3 = " << str3 << endl;

    strcpy(str3, str1);
    cout << "strcpy(str3, str1) : " << str3 << endl;

    strcat(str1, str2);
    cout << "strcat(str1, str2) : " << str1 << endl;

    len = strlen(str1);
    cout << "strlen(str1) : " << len << endl;
    int a = strcmp(str1, str2);
    cout << "strcmp(str1, str2) : " << a << endl;
}

void String()
{
    string str1 = "Hello";
    string str2 = "World";
    string str3;
    int len;

    str3 = str1;
    cout << "str3 = " << str3 << endl;
    str3 = str1 + str2;
    cout << "str3 = " << str3 << endl;
    len = str3.size();
    cout << "str3 size = " << len << endl;
}

void Pointer()
{
    int var1;
    char var2[10];

    cout << "var1 address : ";
    cout << &var1 << endl;

    cout << "Var2 address : ";
    cout << &var2 << endl;
}

int main()
{
    // BinaryCalculate();
    int a = 100;
    int b = 200;
    cout << "交换前的值 a = " << a << " , b = " << b <<endl;
    swap(a, b);
    cout << "交换后的值 a = " << a << " , b = " << b <<endl;

    // printArray();

    // MoreDimensionArray();

    // PointerArray();

    int balance[5] = {1000, 1024, 1201, 21, 121};
    double avg;

    avg = getAverage(balance, 5);

    cout << "数组平均值是 : " << avg << endl;

    int *p;
    p = getRandom();
    for (int i = 0; i < 10; i++)
    {
        cout << "*(p + " << i << ") = ";
        cout << *(p + i) << endl;
    }

    // charString();

    // String();

    Pointer();

    cout << "Hello wsx" << endl;
    return 0;
}
