#include <iostream>
#include <ctime>

using namespace std;

void TimeAndUTC()
{
    time_t now = time(0);
    char *dt = ctime(&now);

    cout << "本地日期和时间: " << dt << endl;

    tm *gmtm = gmtime(&now);
    dt = asctime(gmtm);
    cout << "UTC时间" << dt << endl;
}

int main()
{
    cout << "Hello wxs" << endl;
    return 0;
}