import axios from "axios";

class TicketService {

    api = 'http://localhost:8000/api';

    getUpdatedAuthorization() {
        return {
            'Authorization': `Bearer ` + TokenService.get()
        }
    }

    async getTimes(filmId, date) {
        let response = await axios.post(this.api + `/getTimes`, {
            filmId,
            date
        });

        return response.data;
    }

}

export default new TicketService();
