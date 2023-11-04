#include <opencv2/highgui.hpp>
#include <iostream>

int main() {
    cv::Mat image = cv::Mat(cv::Size(640, 480), CV_8UC4, cv::Scalar(255, 255, 255, 177));
    cv::namedWindow("Mouse Position");
    cv::setMouseCallback("Mouse Position", [](int event, int x, int y, int flags, void* userdata) {
        if (event == cv::EVENT_MOUSEMOVE) {
            std::cout << "Mouse Position: (" << x << ", " << y << ")" << std::endl;
        }
    }, nullptr);

    while (true) {
        cv::imshow("Mouse Position", image);
        if (cv::waitKey(1) == 27)
            break;
    }
    return 0;
}
