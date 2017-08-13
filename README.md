# MMtest - KT

This project serves the purpose of demonstrating a the use of different sorting algorithms in order to sort a list of numbers stored in a file.

## Execution
Processing can be started by executing index.php while passing two parameters. The algorithm name and a number (1-3). 
Each number represents one of the raw data files (which are found under the input directory).
1 - random_100.txt
2 - random_10000.txt
3 - random_10000000.txt

For example:
php -f index.php bubblesort 1
php -f index.php myTestAlgorithm 1
php -f index.php selectionSort 1
php -f index.php quicksort 1

## Index.php file
It accepts the parameters and performs some very basic validation.
It also loads the error handler, the configuration file and the relevant class (depending on the parameter passed).

## Error handling
Implements a very basic error handling with the purpose of centralising and capturing all the errors that might occur from the execution.
In this demonstration it wouldn't be needed because the whole process is initiated by the person who tests the application.
However in a real scenario, this would be initiated automatically (e.g. by cron job or another external script), in which case, the customError() function should properly log the errors.

## Reading from the file
The fileOpen class performs an fopen to get a file handler.
Reading from the file (for all algorithms) is done using the stream_get_line() function which reads from the current file pointer until the next delimiter (,) or the end EOF (thus it reads the numbers one by one).
The reason we use a stream to read from the file is that all the records are in one line and therefore any way of reading which would read the whole line would be very memory intensive and thus inefficient.

## Assumptions
- This implementation assumes that the file contains only numbers separated by comma and that they are all in one line and it does not perform any validation on the data found in the files.
- The numbers in the files are sorted without removing any duplication.

## Algorithms
The implementation for each algorithm is found in the each class (under the Algorithms directory).

### - myTestAlgorithm
This was my first attempt to implement a sorting algorithm. I later discovered that it is very similar to the "Insertion" algorithm.
For every number that it gets from the file, it simply loops through the "Sorted" array and put's it in the right place.
This is the third fastest algorithm implemented.

### - bubblesort
The slowest algorithm of the four. It loops through the array and compares the current value with the next. It then swaps them if required. The process is repeated until no swaps are necessary.

### - selectionSort
This is the second fastest algorithm implemented.
It loops through the unsorted array. It finds the smallest value and moves it to the sorted array (appends).
It seemingly only loops through the unsorted array once, but finding the smallest value every time (min) adds another loop within.

### - quicksort
By far the fastest algorithm implemented.
It first picks a random number (e.g the first). It then compares all the elements against it. Anything smaller is placed before it and anything larger after.
This puts the pivot number in the right place.
Then, each of the two groups (before and after the pivot) goes through the same process individually until the whole array is sorted.

### Performance
Here is some performance comparison between the algorithms for the same set of data:
Algorithm (class used): bubblesort
Time passed: 54.608314990997 Seconds
Peak memory usage: 1.2010040283203 MB

Algorithm (class used): quicksort
Time passed: 0.060135126113892 Seconds
Peak memory usage: 3.1707458496094 MB

Algorithm (class used): selectionSort
Time passed: 8.0624659061432 Seconds
Peak memory usage: 2.209716796875 MB

Algorithm (class used): myTestAlgorithm
Time passed: 36.947177171707 Seconds
Peak memory usage: 1.3511505126953 MB
 



