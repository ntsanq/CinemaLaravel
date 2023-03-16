import axios from "axios";

class FilmService {

    api = 'http://localhost:8000/api';

    getUpdatedAuthorization() {
        return {
            'Authorization': `Bearer ` + TokenService.get()
        }
    }

    async getFilmInfo(filmId) {
        let response = await axios.get(this.api + `/films/${filmId}`);

        return response.data;
    }

    async getWeeklyFilm() {
        let response = await axios.get(this.api + `/getWeeklyFilm/`);

        return response.data;
    }


}

export default new FilmService();
