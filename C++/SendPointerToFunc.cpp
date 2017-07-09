#include <iostream>
#include <ctime>

using namespace std;
void getSeconds(unsigned long *par);

int main()
{
    unsigned long sec;
    getSeconds(&sec);
    cout << "Number of seconds = " << sec << endl;

    cout << "Hello wxs" << endl;
}

void getSeconds(unsigned long *par)
{
    *par = time( NULL );
    return;
}