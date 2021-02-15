# TentsPlus-CMS
A Content Management Site for TentsPlus's backend database.

## Design Process
 
It is often said that innovation is birthed from need. In this case, TentsPlus came about due to Transition Plus' menial and inefficient system for logging data. The TentsPlus team came together to create a database system and an accompanying CMS.

## Features
 
### Existing Features
- Industry Standard CRUD - The CMS is able to Create, Read, Update and Delete entries almost instantaneously. 

- View Modules - Ordinary database viewers like phpmyadmin show individual tables with a dated look. Our CMS allows you to sort different kinds of data for easy viewing and comparison.

### Future Features
- Graphs and Charts - Coming soon to the CMS are graphs and charts. This will allow admins to have a better understanding of the data presented to them through a better form of visual representation.

- More View Modules - Too much of a good thing? We've never heard of that. More view modules means equipping admins with a better ability to compare and view data more efficiently.

## Technologies Used

- [JQuery](https://jquery.com)
    - TentsPlus-CMS uses **JQuery** to simplify DOM manipulation and traversal.

- [ArchitectUI](https://https://architectui.com/)
    - TentsPlus-CMS uses **ArchitectUI** to power better UI/UX. 

- [Database](http://amphibistudio.sg/phpmyadmin/)
    - TentsPlus-CMS uses **Database** to host our backend data. 


## Database Importing
In the event that the database needs to be imported into the server, you will need to first acquire the latest version of the database in .sql format. Using the phpmyadmin interface, do a normal Import into a blank database.

## Testing

1. Logging In/Registering
    You can login with the following account info:
        email: adminlogin1
        password: adminPassword1!

2. CRUD
    After logging in, different tabs will be made available to you on the left. All tabs under "CRUD Tables" have the capability to perform CRUD.

    1. Create
    By clicking the black plus icon in the table, a modal will pop up and allow you to create a new entry for that specific table. The page will refresh to acknowledge a successful entry. Do take note of certain required fields.

    2. Read
    The CMS automatically performs Read queries whenever you click a tab button.

    3. Update
    By clicking the blue edit button in the table row, a modal will pop up and allow you to edit the entry for that specific table. The page will refresh to acknowledge a successful entry. Do take note of certain required fields.

    4. Delete
    In the same modal that pops up when attempting to Update, a red delete button can be seen in the bottom left corner of the modal. Upon clicking it, you will be asked for confirmation of your action. If you confirm the action, the item will be deleted and the page will refresh to acknowledge a successful entry.


## Limitations/Bugs
1. Form validation is currently limited.
2. Not all tables from the backend are displayed.

## Credits

### Content
- The CMS was built with the situation over at Transition Plus in mind.

### Media
- The TentsPlus logo and brand identity have been carefully curated by our team.

### Acknowledgements

- Thank you to Malcolm Yam for your advice.

[Follow TentsPlus-CMS' development here](https://github.com/blocksome/TentsPlus-CMS)



