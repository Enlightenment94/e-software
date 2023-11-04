#include <opencv2/highgui.hpp>

int main() {
    system("scrot -d 1 screenshot.png");

    cv::Mat desktop = cv::imread("screenshot.png", cv::IMREAD_UNCHANGED);

    cv::namedWindow("Screen", cv::WINDOW_NORMAL);
    cv::setWindowProperty("Screen", cv::WND_PROP_FULLSCREEN, cv::WINDOW_FULLSCREEN);
    cv::setWindowProperty("Screen", cv::WND_PROP_AUTOSIZE, cv::WINDOW_AUTOSIZE);
    cv::imshow("Screen", desktop);

    cv::waitKey(0);

    return 0;
}
