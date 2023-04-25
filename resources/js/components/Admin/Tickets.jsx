import * as React from "react";
import {useEffect, useState} from "react";
import {Input, Button} from "antd";
import TicketService from "../../services/TicketService";
import ConfirmationNumberIcon from '@mui/icons-material/ConfirmationNumber';

export const TicketIcon = ConfirmationNumberIcon;

export const TicketList = () => {
    const [inputValue, setInputValue] = useState('');
    const [ticketDetails, setTicketDetails] = useState(null);
    const [messagePlace, setMessagePlace] = useState('Input the session id');
    const onChange = (e) => {
        setInputValue(e.currentTarget.value);
    }

    const handleKeyDown = (e) => {
        if (e.key === "Enter") {
            handleClick();
        }
    };


    const handleClick = () => {
        TicketService.getTickets(inputValue)
            .then(r => {
                setTicketDetails(r.data);
            })
            .catch(e => {
                console.log(e.message);
                setMessagePlace('Wrong session id');
                setTicketDetails(null);
            });
    }

    return (
        <div>
            <div style={{fontSize: "18px", marginTop: "30px", display: "flex", flexDirection: "column", gap: "20px"}}>
                Insert the session Id sent in the email

                <div style={{display: "flex", flexDirection: "row", gap: "20px"}}>
                    <Input onChange={onChange} onKeyDown={handleKeyDown}/>
                    <Button type="primary" onClick={handleClick}>Get info</Button></div>
            </div>

            {
                ticketDetails ? (
                    <>
                        {ticketDetails.map(ticket => {
                            return (
                                <div className="" key={ticket.id}>
                                    <br/>
                                    <div>
                                        Movie: <b>{ticket.film_name}</b>
                                        <br/>
                                        Name: {ticket.user_name}
                                        <br/>
                                        Seat: <b>{ticket.seat_name}</b>
                                        <br/>
                                        Time: {ticket.start_time}
                                        <br/>
                                        Seat type: {ticket.seat_type}
                                    </div>
                                </div>
                            )
                        })}
                    </>
                ) : (<div style={{fontStyle: "italic", fontSize: "14px", marginTop: "5px"}}>
                    <span>
                        {messagePlace}
                    </span>

                </div>)
            }

        </div>
    );
};
