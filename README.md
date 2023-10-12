This script is a demonstration of how the data is to be captured from the mpesa Daraja intergration.

This demonstrate the C2B. 

The Scripts store and process the data. 

When it comes to automation, A call can be made to the function to check any available unposted data from the database.
the check can be done after every 15, 20, 30 or 60 seconds to avoid waiting from the client's side. 


The Index.php in this case accepts the json input and stores into the database table.
The transaction.php fetches from the database any transaction that has not been processed and displays them one at a time.
The update_posting.php updates the status from 0 to either 1,2 or 3.

This way, status 1 indicates successfull posting or registration.
            status 2 and 3 might be due to an error such as 
            - Double posted
            - Wrong Account No
            - Invalid account e.t.c

The Database dump is located in the database folder.

Happy coding.
Regards
Brian Anikayi