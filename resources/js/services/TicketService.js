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
            filmId: filmId,
            date: date
        });

        return response.data;
    }

    async getSeats(roomId) {
        let response = await axios.post(this.api + `/getSeats`, {
            roomId: roomId
        });

        return response.data;
    }

    async getSeatInfo(seatId) {
        let response = await axios.get(this.api + `/seats/${seatId}`);

        return response.data;
    }

    async book(filmId, scheduleTime, seats, discountId, userId, payment) {
        let response = await axios.post(this.api + `/confirmBooking`, {
            filmId: filmId,
            scheduleTime: scheduleTime,
            seats: seats,
            discountId: discountId,
            userId: userId,
            payment: payment
        });

        return response.data;
    }

    async getTickets(sessionId) {
        let response = await axios.post(this.api + `/getTickets`, {
            sessionId: sessionId
        });

        return response.data;
    }

    async printed(sessionId) {
        let response = await axios.post(this.api + `/printed`, {
            sessionId: sessionId
        });

        return response.data;
    }

    async getTotal(sessionId) {
        let response = await axios.post(this.api + `/tickets/getTotal`, {
            sessionId: sessionId
        });

        return response.data;
    }
}

export default new TicketService();
