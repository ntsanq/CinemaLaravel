import React from 'react';
import {useState} from "react";

export default function SeatPick(props) {

    const [selectedSeats, setSelectedSeats] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState(null);

    const allSeats = props.seatsData.allSeats;
    const occupied = props.seatsData.occupied;

    const seatsCategory = [
        {
            name: 'Poor',
            price: 120000,
            seats: allSeats,
            occupied: occupied
        },
        {
            name: "VIP",
            price: 200000,
            seats: [11, 12],
            occupied: [11]
        }
    ];

    const handleOnClick = (seat, category) => {
        const isSelected = selectedSeats.indexOf(seat) > -1;
        if (isSelected) {
            const newSelectedSeats = selectedSeats.filter(
                (selectedSeat) => selectedSeat !== seat
            );
            setSelectedSeats(newSelectedSeats);
        } else {
            if (
                selectedSeats.length !== 0 &&
                selectedCategory &&
                selectedCategory.name !== category.name
            ) {
                alert("Select seats from same category");
            } else if (selectedSeats.length > 5) {
                alert("Maximum 5 seats allowed");
            } else {
                setSelectedSeats([...selectedSeats, seat]);
                setSelectedCategory(category);
            }
        }
    };


    return (
        <>
            <h1 className='hi'>Seat picker</h1>
            <div className="screen">
                {seatsCategory.map((category) => {
                    const noOfRows = Math.ceil(category.seats.length / 8);
                    const newSeatList = [];
                    for (let i = 0; i < noOfRows; i++) {
                        newSeatList[i] = category.seats.slice(i * 8, i * 8 + 8);
                    }
                    return (
                        <div className="seats-section" key={category.seats}>
                            <h4>{category.name}</h4>
                            {newSeatList.map((seats, i) => (
                                <div key={i} className="seats">
                                    {seats.map((seat, j) => {
                                        const isSelected = selectedSeats.indexOf(seat) > -1;
                                        const isOccupied = category.occupied.indexOf(seat) > -1;
                                        return (
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
                                        );
                                    })}
                                </div>
                            ))}
                        </div>
                    );
                })}
                <div className="total">
                    <span> Seats Count: {selectedSeats.length}</span>{" "}
                    <span>
          Price: $
                        {selectedCategory ? selectedSeats.length * selectedCategory.price : 0}
        </span>
                </div>
            </div>
        </>
    );
}
