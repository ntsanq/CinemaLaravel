import React, {useEffect, useState} from 'react';
import {createRoot} from "react-dom/client";
import {Button, Modal} from "antd";
import TicketService from "../../services/TicketService";

export default function TicketDetailsPopup(props) {
    let sessionId = '';
    if (props.sessionId) {
        sessionId = props.sessionId;
    }
    if (props.tickets) {
        const ticketsData = JSON.parse(props.tickets);
        sessionId = ticketsData[0].session_id;
    }

    const [tickets, setTickets] = useState([]);
    const [total, setTotal] = useState([]);

    useEffect(() => {
        TicketService.getTickets(sessionId).then(r => {
            setTickets(r.data);
        }).catch(e => {
            console.log(e)
        });

        TicketService.getTotal(sessionId).then(r => {
            setTotal(r.data.amount_total);
        }).catch(e => {
            console.log(e)
        });
    }, [])

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
                {props.tickets ? 'here' : <i className='uk-icon-eye'></i>}
            </span>
            <Modal title="Ticket Information" open={isModalOpen} onOk={handleOk} onCancel={handleCancel}
                   footer={[
                       <Button key="submit" type="default" onClick={handleCancel}>
                           Close
                       </Button>,
                   ]}
                   width={700}
            >
                {tickets.map(ticket => {
                    return (
                        <div className="uk-flex uk-flex-center" key={ticket.id}>
                            <div className="cardWrap">
                                <div className="card cardLeft">
                                    <div className="uk-flex uk-flex-column">
                                        <div className="uk-text-contrast">SAN Cinema</div>
                                    </div>
                                    <div className="uk-margin-small-left">
                                        <div
                                            className="uk-flex uk-flex-column ticket--film-name uk-margin-top uk-margin-small-bottom
                                    ticket--movie-name">
                                            <span className="ticket-label">
                                                Movie
                                            </span>
                                            <span>
                                                {ticket.film_name}
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
                                                <span>{ticket.start_time}</span>
                                            </div>
                                            <div
                                                className="uk-flex uk-flex-column ticket--seat-info--date uk-margin-large-left">
                                                <span className="ticket-label">Date</span>
                                                <span>{ticket.start_date}</span>
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
                                    <div className="barcode uk-text-center"></div>
                                </div>
                            </div>
                        </div>
                    )
                })}
                <div className="uk-margin-top">Total price: {total}</div>

            </Modal>
        </>

    );
}

if (document.getElementById('ticket-details-popup')) {
    let tickets = document.getElementById('ticket-details-popup').getAttribute('tickets');
    createRoot(document.getElementById('ticket-details-popup')).render(<TicketDetailsPopup tickets={tickets}/>);
}

if (document.getElementsByClassName('ticket-details-popup')) {
    const rows = document.querySelectorAll('.ticket-details-popup');
    rows.forEach(row => {
        const sessionId = row.getAttribute('data-session-id');
        createRoot(row).render(<TicketDetailsPopup sessionId={sessionId}/>);
    });
}
