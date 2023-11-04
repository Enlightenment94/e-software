#include <opencv2/opencv.hpp>
#include <opencv2/videoio.hpp>

int main()
{
    cv::VideoCapture capture(0);
    cv::Mat frame;

    cv::VideoWriter writer("screen_record.avi", cv::VideoWriter::fourcc('M','J','P','G'),
                           15, cv::Size(capture.get(cv::CAP_PROP_FRAME_WIDTH),
                           capture.get(cv::CAP_PROP_FRAME_HEIGHT)));

    while (true)
    {
        capture >> frame;
        writer.write(frame);
        cv::imshow("Screen Recorder", frame);

        if (cv::waitKey(10) == 27)
            break;
    }

    capture.release();
    writer.release();
    cv::destroyAllWindows();

    return 0;
}
