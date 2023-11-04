#include <iostream>
#include <string>
#include <opencv2/opencv.hpp>

int main(int argc, char** argv) {
  // Ustawienia nagrywania:
  std::string file_name = "screen_capture.avi";
  cv::Size screen_size = cv::Size(1280, 720);
  int fps = 30;

  // Inicjalizacja obiektów OpenCV:
  cv::VideoCapture capture(cv::CAP_ANY);
  cv::VideoWriter writer;

  if (!capture.isOpened()) {
    std::cerr << "Nie można otworzyć urządzenia do nagrywania!" << std::endl;
    return -1;
  }

  std::cout << "Rozpoczynam nagrywanie. Naciśnij S, aby zapisać film i zakończyć nagrywanie." << std::endl;

  // Nagrywanie i zapisywanie filmu:
  cv::Mat frame;
  char key = ' ';
  bool recording = true;

  while (recording) {
    capture >> frame;

    if (writer.isOpened()) {
      writer.write(frame);
    } else {
      writer.open(file_name, cv::VideoWriter::fourcc('X', 'V', 'I', 'D'), fps, screen_size, true);

      if (!writer.isOpened()) {
        std::cerr << "Nie można zapisać filmu na dysku!" << std::endl;
        return -1;
      }
    }

    cv::imshow("Screen Capture", frame);

    key = cv::waitKey(1000 / fps);

    if (key == 's' || key == 'S') {
      recording = false;
    }
  }

  // Czyszczenie i zamykanie aplikacji:
  capture.release();
  writer.release();
  cv::destroyAllWindows();

  std::cout << "Nagrywanie zakończone. Film został zapisany jako " << file_name << std::endl;

  return 0;
}
