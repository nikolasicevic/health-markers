# Health Markers Application

Health Markers Application (HMA) helps you keep track of your sleep, diet and activity habbits. This particular piece of software is on git mostly for representational purposes, but if you want to do so, yo can use it yourself. More in Installation & Usage section on how to do that.

## Description

HMA helps you keep track and visualize the data related your sleep, diet and activity habbits. It does so by you enetering the data, and the app outputs the record of days along with the information about sleep, meals, activity, and energy levels for every particular day. That record can be searched by different criteria, average values are calculated for the selected range of days, and the data is represented visually on the line chart. 

It is also possible to generate a PDF report and send it to your e-mail address. Reports for previous 7, 30 and 90 days are available.

## Instalation

Clone the repository:

```bash
git clone https://github.com/nikolasicevic/health-markers.git
```

Enter into project directory:

```bash
cd health-markers
```

Run composer:

```bash
composer install
composer update
```

Copy .env file:

```bash
copy .env.example .env
```

Fill out .env file attributes: 
```bash
DB_DATABASE= // your datase name
DB_USERNAME= // your database username
DB_PASSWORD= // your database password

MAIL_USERNAME= // mail address from which reports will be sent
MAIL_PASSWORD= // password for the associating address
MAIL_FROM_ADDRESS= // mail address from which reports will be sent

REPORT_MAIL= // mail to which reports will be sent
```

Run Artisan:

```bash
php artisan key:generate
```

Create database tables:

```bash
php artisan migrate
```

## Usage

### Main Menu

Main menu has following options:

Početna - Sends you back to the home page
Izveštaj za poslednjih 7 dana (Report for the last 7 days) - Sends a report for the last 7 days
Izveštaj za poslednjih 30 dana (Report for the last 30 days) - Sends a report for the last 30 days
Izveštaj za poslednjih 90 dana (Report for the last 90 days) - Sends a report for the last 90 days

Other options form the main menu are unavailable for now.

### Home Page

Home page consists of header, stats section and the list of previous 7 days with some information about each day.

<strong>Header</strong>

Header has two buttons - "Prikaži sve dane" (Show all days) and "Unesi podatke za danas" (Enter data for today). First one sends you to the page where you can search all available days bu different criteria. The second one sends you to the page with the detailed information about today.

<strong>Stats</strong>

Thera are three tabs at the top of the section - "Poslednjih 7 dana" (Last 7 days), "Poslednjih 30 dana" (Last 30 days), and "Poslednjih 90 dana" (Last 90 days). By clicking on one of them, following information will be shown on the rest of the screen:

<i>Average values for the selected day range</i>

<ul>
    <li>"Prosečno trajanje sna" (Average sleep time)</li>
    <li>"Prosečno vreme spavanja" (Average time you fell asleep)</li>
    <li>"Prosečno vreme buđenja" (Average time you woke up)</li>
    <li>"Prosečan broj obroka" (Average number of meals)</li>
    <li>"Prosečno trajanje aktivnosti" (Average activity duration)</li>
    <li>"Prosečan nivo energije" (Average energy level)</li>
</ul>

<i>Line chart with the following data about each day</i>

<ul>
    <li>Total duration of sleep (blue line)</li>
    <li>Number of meals (green line)</li>
    <li>Number of activities (red line)</li>
    <li>Energy level (yellow line)</li>
</ul>

<strong>Days</strong>

Previous 7 days is listed. Information about each day is divided into sections:

<ul>
    <li><i>San (Sleep)</i>: Shows fall asleep time, wake up time, and the total sleep duration for that day.</li>
    <li><i>Obroci (Meals)</i>: Shows the number of meals for that day.</li>
    <li><i>Aktivnost (Activity)</i>: Shows all the activities you had on that day along with total duration of all of them.</li>
    <li><i>Energia (Energy)</i>: Shows the energy level for that day (0-10).</li>
</ul>

By clicking on any of the days in the list, you will be sent to the page with all the details about a particular day.

### All Days Page

Page consistes of 3 parts, average values (same thing as on the Home Page), search form, list of days.

<i>Average values</i>

Values are displayed for the range of days resulted from search. Default values are based on the last 100 days.

<i>Search form</i>

<ul>
    <li>Dani sa energijom manjom od (Days with the energy level less than): Get all the days with the level of energy equal or lesser than the input value.</li>
    <li>Dani sa energijom većom od (Days with the energy level greater that): Get all the days with the level of energy equal or greater than the input value.</li>
    <li>Dani pre datuma (Days before the date): Get all the days with the date value equal or lesser than the input value.</li>
    <li>Dani posle datuma (Days after the date): Get all the days with the date value equal or greater than the input value.</li>
    <li>Dani sa manjim trajanjem sna (Days with sleep duration less than): Get all the days with the sleep duration equal or lesser than the input value.</li>
    <li>Dani sa većim trajanjem sna (Days with sleep duration greater that): Get all the days with the sleep duration equal or greater than the input value.</li>
    <li>Dani sa aktivnošću kraćom od (Days with activity duration less than): Get all the days with the total activity duration equal or lesser than the input value.</li>
    <li>Dani sa aktivnošću dužom od (Days with activity duration greater than): Get all the days with the total activity duration equal or greater than the input value.</li>
</ul>

<i>List of days</i>

All days that meet the search criteria. Default value is last 100 days. By clicking on any of the days in the list, you will be sent to the page with all the details about a particular day.

### Show Day Page

This page consists of 4 sections:

<strong>San (Sleep)</strong>

Section with the blue background displays the information about when you fell asleep, when you woke up, and what is the duration of sleep based on those two entries. 

By clicking on the buttton "Promeni" (Edit), you are sent to the page where you can edit fall aslepp and wake up time.

<strong>Obroci (Meals)</strong>

Section with the green background displays the names and times of all the meals you entered. 

By clicking on the buttton "Dodaj" (Add), you are sent to the page where you can add the name and time of the new meal.

By clicking on the buttton "Promeni" (Edit), you are sent to the page where you can edit the name and time of the particular meal.

By clicking on the buttton "Izbriši" (Delete), you will delete that particular meal.


<strong>Aktivnost (Activity)</strong>

Section with the red background displays the names and durations of all the activities you entered. 

By clicking on the buttton "Dodaj" (Add), you are sent to the page where you can add the name and duration of the new activity.

By clicking on the buttton "Promeni" (Edit), you are sent to the page where you can edit the name and duration of the particular activity.

By clicking on the buttton "Izbriši" (Delete), you will delete that particular activity.

<strong>Nivo Energije (Energy Level)</strong>

Energy level is a subjective feeling of energy for the day. It is displayed on the scale of 1-10 in the form of blocks. You can change energy level by clicking on the block and by clicking on the "Sačuvaj energiju" (Save energy) button.

### Edit Sleep Session Page

Only two values can be changed: "Zaspao si" (You fell asleep at) and "Probudio si se" (You woke up at), where fall asleep time cannot be a time after the wake up time. Default value for the fall asleep time is yesterday, 23:00. Default value for the wake up time is today, 07:00.

### Create Meal Page

Two values can be added: "Naziv" (Name) and "Vreme" (Time).

### Edit Meal Page

Two values can be changed: "Naziv" (Name) and "Vreme" (Time).

### Create Activity Page

Two values can be added: "Naziv" (Name) that you choose from the list of activity names, and "Trajanje" (Duration) in hours where you input it in the form of a decimal number with a double precision.

### Edit Activity Page

Two values can be change: "Naziv" (Name) that you choose from the list of activity names, and "Trajanje" (Duration) in hours where you input it in the form of a decimal number with a double precision. The default value of the duration field is 1.30 hours.

## License

Health Markers Application is licensed under MIT License (https://opensource.org/licenses/MIT)
