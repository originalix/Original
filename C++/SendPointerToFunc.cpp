#include <iostream>
#include <ctime>

using namespace std;
void getSeconds(unsigned long *par);
double getAverage(int *arr, int size);

int main()
{
    unsigned long sec;
    getSeconds(&sec);
    cout << "Number of seconds = " << sec << endl;

    int balance[5] = {21, 50, 121, 1201, 135};
    double avg;
    avg = getAverage(balance, 5);
    cout << "Average value is : " << avg << endl;

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