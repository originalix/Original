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
    time_t now = time(0);
    cout << "Number of sec since January 1, 1970: " << now << endl;

    tm *ltm = localtime(&now);

    //输出tm结构的各个组成部分
    cout << "Year: " << 1900 + ltm->tm_year << endl;
    cout << "Month: " << 1 + ltm->tm_mon << endl;
    cout << "Day: " << ltm->tm_mday << endl;
    cout << "Time: " <<  ltm->tm_hour << ":";
    cout << ltm->tm_min << ":";
cout << ltm->tm_sec << endl;

    cout << "Hello wxs" << endl;
    return 0;
}