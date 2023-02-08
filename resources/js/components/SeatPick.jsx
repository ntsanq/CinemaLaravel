import React from 'react';
import {useState} from "react";

export default function SeatPick() {

    const [selectedSeats, setSelectedSeats] = useState([]);
    const [selectedCatogory, setSelectedCatogory] = useState(null);

    const seatsCatogory = [
        {
            name: "Club",
            price: 236,
            seats: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            occupied: [2, 3]
        },
        {
            name: "Executive",
            price: 200,
            seats: [
                11,
                12,
                13,
                14,
                15,
                16,
                17,
                18,
                19,
                20,
                21,
                22,
                23,
                24,
                25,
                26,
                27,
                28,
                29,
                30
            ],
            occupied: [26]
        }
    ];

    const handleOnClick = (seat, catogory) => {
        const isSelected = selectedSeats.indexOf(seat) > -1;
        if (isSelected) {
            const newSelectedSeats = selectedSeats.filter(
                (selectedSeat) => selectedSeat !== seat
            );
            setSelectedSeats(newSelectedSeats);
        } else {
            if (
                selectedSeats.length !== 0 &&
                selectedCatogory &&
                selectedCatogory.name !== catogory.name
            ) {
                alert("Select seats from same catogory");
            } else if (selectedSeats.length > 5) {
                alert("Maximum 5 seats allowed");
            } else {
                setSelectedSeats([...selectedSeats, seat]);
                setSelectedCatogory(catogory);
            }
        }
    };


    return (
        <>
            <h1 className='hi'>Seat picker</h1>
            <div className="screen">
                {seatsCatogory.map((catogory) => {
                    const noOfRows = Math.ceil(catogory.seats.length / 8);
                    const newSeatList = [];
                    for (let i = 0; i < noOfRows; i++) {
                        newSeatList[i] = catogory.seats.slice(i * 8, i * 8 + 8);
                    }
                    return (
                        <div className="seats-section" key={catogory.seats}>
                            <h4>{catogory.name}</h4>
                            {newSeatList.map((seats, i) => (
                                <div key={i} className="seats">
                                    {seats.map((seat, j) => {
                                        const isSelected = selectedSeats.indexOf(seat) > -1;
                                        const isOccupied = catogory.occupied.indexOf(seat) > -1;
                                        return (
                                            <div
                                                key={`seat-${seat + j}`}
                                                className={`seat ${isSelected ? "selected" : ""} ${
                                                    isOccupied ? "occupied" : ""
                                                }`}
                                                onClick={() => {
                                                    if (!isOccupied) {
                                                        handleOnClick(seat, catogory);
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
                        {selectedCatogory ? selectedSeats.length * selectedCatogory.price : 0}
        </span>
                </div>
            </div>
        </>
    );
}
