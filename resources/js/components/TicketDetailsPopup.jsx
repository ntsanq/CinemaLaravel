import React, {useEffect, useState} from 'react';
import {createRoot} from "react-dom/client";
import {Button, Modal} from "antd";
import TicketService from "../services/TicketService";

export default function TicketDetailsPopup(props) {
    const ticketsData = JSON.parse(props.tickets);
    const sessionId = ticketsData[0].session_id;
    const [tickets, setTickets] = useState([]);

    TicketService.getTickets(sessionId).then(r => {
        setTickets(r.data);
    }).catch(e => {
        console.log(e)
    });

    const [isModalOpen, setIsModalOpen] = useState(false);

    const showModal = () => {
        setIsModalOpen(true);
    };

    const handleOk = () => {
        setIsModalOpen(false);
    };

    const handleCancel = () => {
        setIsModalOpen(false);
    };

    return (
        <>
            <span className="uk-link" onClick={showModal}>
                here
            </span>
            <Modal title="Ticket Information" open={isModalOpen} onOk={handleOk} onCancel={handleCancel}
                   footer={[
                       <Button key="submit" type="default" onClick={handleCancel}>
                           Close
                       </Button>,
                   ]}
            >
                {tickets.map(ticket => {
                    return (
                        <div className="uk-flex uk-flex-center" key={ticket.id}>
                            <div className="cardWrap">
                                <div className="card cardLeft">
                                    <div className="uk-flex uk-flex-column">
                                        <div className="uk-text-contrast">Sang Flixer Cinema</div>
                                    </div>
                                    <div className="uk-margin-small-left">
                                        <div
                                            className="uk-flex uk-flex-column ticket--film-name uk-margin-top uk-margin-small-bottom
                                    ticket--movie-name">
                                <span className="ticket-label">
                                    Movie
                                </span>{ticket.film_name}<span className="">

                                </span>
                                        </div>
                                        <div
                                            className="uk-flex uk-flex-column ticket--book-person uk-margin-small-bottom
                                    ticket--person-name">
                                 <span className="ticket-label">
                                    Name
                                </span>
                                            <span>{ticket.user_name}</span>
                                        </div>
                                        <div className="uk-flex uk-flex-row ticket--seat-info uk-margin-bottom">
                                            <div className="uk-flex uk-flex-column ticket--seat-info--seat">
                                                <span className="ticket-label">Seat</span>
                                                <span>{ticket.seat_name}</span>
                                            </div>
                                            <div
                                                className="uk-flex uk-flex-column ticket--seat-info--time uk-margin-large-left">
                                                <span className="ticket-label">Time</span>
                                                <span>13:30</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="card cardRight">
                                    <div className=""></div>
                                    <div className="number uk-margin-large-top">
                                        <h3>{ticket.seat_name}</h3>
                                        <span>{ticket.seat_type}</span>
                                    </div>
                                    <div className="barcode"></div>
                                </div>
                            </div>
                        </div>
                    )
                })}

            </Modal>
        </>

    );
}

if (document.getElementById('ticket-details-popup')) {
    let tickets = document.getElementById('ticket-details-popup').getAttribute('tickets');
    createRoot(document.getElementById('ticket-details-popup')).render(<TicketDetailsPopup tickets={tickets}/>);
}
