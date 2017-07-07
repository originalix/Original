#include <iostream>
using namespace std;

enum star
{
    kobe,
    curry,
    durant,
    klay
};

int main()
{
    cout << "Size of char : " << sizeof(char) << endl;
    cout << "Size of int : " << sizeof(int) << endl;
    cout << "Size of short int : " << sizeof(short int) << endl;
    cout << "Size of long int : " << sizeof(long int) << endl;
    cout << "Size of float : " << sizeof(float) << endl;
    cout << "Size of double : " << sizeof(double) << endl;
    cout << "Size of wchar_t : " << sizeof(wchar_t) << endl;

    enum star somebody = kobe;
    if (somebody == curry)
    {
        cout << "this is curry shot";
    } else {
        cout << "this is " << somebody << " shot" <<endl;
    }
    return 0;
}
