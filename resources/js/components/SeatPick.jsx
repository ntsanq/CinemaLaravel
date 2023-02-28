import React, {useEffect} from 'react';
import {useState} from "react";
import Loading from "./Loading";

export default function SeatPick(props) {

    const alpha = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];

    const allSeats = props.seatsData.allSeats === undefined ? [] : props.seatsData.allSeats;
    const occupied = props.seatsData.occupied;

    const [selectedSeats, setSelectedSeats] = useState([]);

    const [loading, setLoading] = useState(true)

    useEffect(() => {
        setTimeout(() => {
            setLoading(false)
        }, 1000)
    }, [])


    const seatsCategory = [
        {
            seats: allSeats,
            occupied: occupied
        }
    ];

    const handleOnClick = (seat) => {
        props.onData(seat);
        const isSelected = selectedSeats.indexOf(seat) > -1;
        if (isSelected) {
            const newSelectedSeats = selectedSeats.filter(
                (selectedSeat) => selectedSeat !== seat
            );
            setSelectedSeats(newSelectedSeats);
        } else {
            setSelectedSeats([...selectedSeats, seat]);
        }
    };

    return (
        <>
            {
                loading ? <Loading/> :
                <>
                    <div className="screen"></div>
                    <div className="all-seats">
                        {seatsCategory.map((category, k) => {
                            const noOfRows = Math.ceil(category.seats.length / 8);
                            const newSeatList = [];
                            for (let i = 0; i < noOfRows; i++) {
                                newSeatList[i] = category.seats.slice(i * 8, i * 8 + 8);
                            }
                            return (
                                <div className="seats-section" key={k}>
                                    <h4>{category.name}</h4>
                                    {newSeatList.map((seats, i) => (
                                        <div key={`${k}-${i}`} className="seats">
                                            {seats.map((seat, j) => {
                                                const isSelected = selectedSeats.indexOf(seat) > -1;
                                                const isOccupied = category.occupied.indexOf(seat) > -1;
                                                return (
                                                    <React.Fragment key={`seat-${seat + j}`}>
                                                        <span> {j + 1}{alpha[i]}</span>
                                                        <div
                                                            key={`seat-${seat + j}`}
                                                            className={`seat ${isSelected ? "selected" : ""} ${
                                                                isOccupied ? "occupied" : ""
                                                            }`}
                                                            onClick={() => {
                                                                if (!isOccupied) {
                                                                    handleOnClick(seat, category);
                                                                } else {
                                                                    null;
                                                                }
                                                            }}
                                                        />
                                                    </React.Fragment>
                                                );
                                            })}
                                        </div>
                                    ))}
                                </div>
                            );
                        })}
                    </div>
                </>
            }
        </>
    );
}
