# NC1 test task

Built with these technologies for [NC1](https://nc-one.com)
<table>
    <tr>
        <td>
            <a href="https://laravel.com" title="Laravel"><img src="https://i.imgur.com/pBNT1yy.png" /></a>
        </td>
        <td>
            <a href="https://vuejs.org/" title="VueJS"><img src="https://i.imgur.com/BxQe48y.png" /></a>
        </td>
        <td>
            <a href="https://tailwindcss.com/" title="TailwindCSS"><img src="https://i.imgur.com/wdYXsgR.png" /></a>
        </td>
    </tr>
</table> 


## Requirements
Need to have PHP version **8.0** or above. Node.js version **12.0** or above.


## Installation

#### Backend
1. Download the project (or better clone using GIT)
2. Go to the project's root directory using terminal
3. Run `composer install`
4. Create database
5. Copy `.env.example` into `.env` file and configure database credentials. Adjust other  parameters, if needed.
6. Run migrations and database default seeder.

    `php artisan migrate --seed`

    <i><u>Note:</u></i> you may want to modify `data.csv` file included within `database/seeders` folder, or delete it to seed `properties` table with Laravel's generic data.
7. Run `php artisan serve` to start the local server at http://localhost:8000

#### Frontend
1. Open new terminal session and navigate to `vue` folder
2. Run `npm install` to install vue.js project dependencies
3. Copy `vue/.env.example` into `vue/.env` and adjust the `VITE_API_BASE_URL` parameter
4. Start frontend by running `npm run dev` (starts vite server for Vue)
5. Open http://localhost:5173

## Notes for reviewer

I did not use optional [`Element UI`](https://element.eleme.io/#/en-US) components library because it is for Vue2. While I know there is a newer version (called [Element Plus](https://element-plus.org/en-US/)) for Vue3, I decided to use alternative Vue components simply because I did not want to mix style approach between those proposed with Taiwindcss and general 'css styling' approach.

## License

The project is privately distributed. Intended for review for NC1 company members only.
