#include <iostream>
#include <ctime>
#include <cstdlib>

using namespace std;
void getSeconds(unsigned long *par);
double getAverage(int *arr, int size);

int * getRandom()
{
    static int r[10];

    srand( (unsigned)time( NULL ) );
    for (int i = 0; i < 10; ++i)
    {
        r[i] = rand();
        cout << r[i] << endl;
    }

    return r;
}

void Reference()
{
    int i;
    double d;

    int &r = i;
    double &s = d;

    i = 5;
    cout << "Value of i : " << i << endl;
    cout << "Value of reference : " << r << endl;

    d = 21.50;
    cout << "Value of d : " << d << endl;
    cout << "Value of reference : " << s << endl;
}

int main()
{
    unsigned long sec;
    getSeconds(&sec);
    cout << "Number of seconds = " << sec << endl;

    int balance[5] = {21, 50, 121, 1201, 135};
    double avg;
    avg = getAverage(balance, 5);
    cout << "Average value is : " << avg << endl;

    int *p;
    p = getRandom();
    for (int i = 0; i < 10; i++)
    {
        cout << "*(p + " << i << ") = " ;
        cout << *(p + i) << endl;
    }

    Reference();

    cout << "Hello wxs" << endl;
}

void getSeconds(unsigned long *par)
{
    *par = time( NULL );
    return;
}

double getAverage(int *arr, int size)
{
    int i, sum = 0;
    double avager;

    for (i = 0; i < size; i++)
    {
        sum += arr[i];
    }

    avager = (double)sum / size;
    return avager;
}