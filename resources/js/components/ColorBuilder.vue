<template>
    <div>
        <recursive-select
            :options="selections"
            v-model="selectedColor"
        ></recursive-select>
        <input type="hidden" v-for="item of selectedColor" :name="`${name}[]`" :value="item">
    </div>
</template>

<script>
import RecursiveSelect from "./RecursiveSelect.vue";

export default {
    components: {RecursiveSelect},
    props: {
        name: String,
        shadedLabel: String,
        fullColorLabel: String,
        mostUsedLabel: String,
        othersLabel: String,
        fullColorLabels: Object,
        shadedColorLabels: Object,
        minkColorLabels: Array,
        siameseHimalayanColorLabels: Object,
        value: {
            type: Array,
            value: () => [],
        }
    },
    data() {
        return {
            selectedColor: this.value,
            selections: [
                {
                    label: this.shadedLabel,
                    value: 'shaded',
                    values: [
                        {
                            label: this.shadedColorLabels[0],
                            value: 0,
                        },
                        {
                            label: this.shadedColorLabels[1],
                            value: 1,
                            values: {
                                [this.mostUsedLabel]: [
                                    // null,
                                    {
                                        label: this.fullColorLabels[1],
                                        value: 1,
                                    },
                                    {
                                        label: this.fullColorLabels[24],
                                        value: 24,
                                    },
                                    {
                                        label: this.fullColorLabels[25],
                                        value: 25,
                                    },
                                ],
                                [this.othersLabel]: [
                                    {
                                        label: this.fullColorLabels[2],
                                        value: 2,
                                    },
                                    {
                                        label: this.fullColorLabels[3],
                                        value: 3,
                                    },
                                    {
                                        label: this.fullColorLabels[4],
                                        value: 4,
                                    },
                                    {
                                        label: this.fullColorLabels[6],
                                        value: 6,
                                    },
                                    {
                                        label: this.fullColorLabels[7],
                                        value: 7,
                                    },
                                    {
                                        label: this.fullColorLabels[8],
                                        value: 8,
                                    },
                                    {
                                        label: this.fullColorLabels[9],
                                        value: 9,
                                    },
                                    {
                                        label: this.fullColorLabels[10],
                                        value: 10,
                                    },
                                    {
                                        label: this.fullColorLabels[11],
                                        value: 11,
                                    },
                                    {
                                        label: this.fullColorLabels[12],
                                        value: 12,
                                    },
                                    {
                                        label: this.fullColorLabels[13],
                                        value: 13,
                                    },
                                    {
                                        label: this.fullColorLabels[14],
                                        value: 14,
                                    },
                                    {
                                        label: this.fullColorLabels[15],
                                        value: 15,
                                    },
                                    {
                                        label: this.fullColorLabels[16],
                                        value: 16,
                                    },
                                    {
                                        label: this.fullColorLabels[17],
                                        value: 17,
                                    },
                                    {
                                        label: this.fullColorLabels[18],
                                        value: 18,
                                    },
                                    {
                                        label: this.fullColorLabels[19],
                                        value: 19,
                                    },
                                    {
                                        label: this.fullColorLabels[38],
                                        value: 38,
                                    },
                                    {
                                        label: this.fullColorLabels[39],
                                        value: 39,
                                    },
                                    {
                                        label: this.fullColorLabels[23],
                                        value: 23,
                                    },
                                    {
                                        label: this.fullColorLabels[26],
                                        value: 26,
                                    },
                                    {
                                        label: this.fullColorLabels[27],
                                        value: 27,
                                    },
                                    {
                                        label: this.fullColorLabels[28],
                                        value: 28,
                                    },
                                    {
                                        label: this.fullColorLabels[29],
                                        value: 29,
                                    },
                                    {
                                        label: this.fullColorLabels[30],
                                        value: 30,
                                    },
                                    {
                                        label: this.fullColorLabels[31],
                                        value: 31,
                                    },
                                    {
                                        label: this.fullColorLabels[32],
                                        value: 32,
                                    },
                                    {
                                        label: this.fullColorLabels[33],
                                        value: 33,
                                    },
                                    {
                                        label: this.fullColorLabels[34],
                                        value: 34,
                                    },
                                    {
                                        label: this.fullColorLabels[36],
                                        value: 36,
                                    },
                                    {
                                        label: this.fullColorLabels[37],
                                        value: 37,
                                    },
                                ]
                            }
                        },
                        {
                            label: this.shadedColorLabels[12],
                            value: 12,
                            values: [
                                {
                                    label: this.fullColorLabels[1],
                                    value: 1,
                                }
                            ]
                        },
                        {
                            label: this.shadedColorLabels[5],
                            value: 5,
                            values: {
                                [this.mostUsedLabel]: [
                                    {
                                        label: this.siameseHimalayanColorLabels[5],
                                        value: 5,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[1],
                                        value: 1,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[24],
                                        value: 24,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[25],
                                        value: 25,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[2],
                                        value: 2,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[28],
                                        value: 28,
                                    },
                                ],
                                [this.othersLabel]: [
                                    {
                                        label: this.siameseHimalayanColorLabels[3],
                                        value: 3,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[4],
                                        value: 4,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[6],
                                        value: 6,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[7],
                                        value: 7,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[8],
                                        value: 8,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[9],
                                        value: 9,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[10],
                                        value: 10,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[11],
                                        value: 11,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[12],
                                        value: 12,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[13],
                                        value: 13,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[14],
                                        value: 14,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[15],
                                        value: 15,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[16],
                                        value: 16,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[17],
                                        value: 17,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[18],
                                        value: 18,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[19],
                                        value: 19,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[21],
                                        value: 21,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[22],
                                        value: 22,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[23],
                                        value: 23,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[26],
                                        value: 26,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[27],
                                        value: 27,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[29],
                                        value: 29,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[30],
                                        value: 30,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[31],
                                        value: 31,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[32],
                                        value: 32,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[33],
                                        value: 33,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[34],
                                        value: 34,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[36],
                                        value: 36,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[37],
                                        value: 37,
                                    },
                                ],
                            },
                        },
                        {
                            label: this.shadedColorLabels[2],
                            value: 2,
                        },
                        {
                            label: this.shadedColorLabels[3],
                            value: 3,
                            values: {
                                [this.mostUsedLabel]: [
                                    {
                                        label: this.siameseHimalayanColorLabels[5],
                                        value: 5,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[1],
                                        value: 1,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[24],
                                        value: 24,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[25],
                                        value: 25,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[2],
                                        value: 2,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[28],
                                        value: 28,
                                    },
                                ],
                                [this.othersLabel]: [
                                    {
                                        label: this.siameseHimalayanColorLabels[3],
                                        value: 3,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[4],
                                        value: 4,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[6],
                                        value: 6,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[7],
                                        value: 7,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[8],
                                        value: 8,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[9],
                                        value: 9,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[10],
                                        value: 10,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[11],
                                        value: 11,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[12],
                                        value: 12,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[13],
                                        value: 13,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[14],
                                        value: 14,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[15],
                                        value: 15,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[16],
                                        value: 16,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[17],
                                        value: 17,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[18],
                                        value: 18,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[19],
                                        value: 19,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[38],
                                        value: 38,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[39],
                                        value: 39,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[23],
                                        value: 23,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[26],
                                        value: 26,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[27],
                                        value: 27,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[29],
                                        value: 29,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[30],
                                        value: 30,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[31],
                                        value: 31,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[32],
                                        value: 32,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[33],
                                        value: 33,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[34],
                                        value: 34,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[36],
                                        value: 36,
                                    },
                                    {
                                        label: this.siameseHimalayanColorLabels[37],
                                        value: 37,
                                    },
                                ],
                            },
                        },
                        {
                            label: this.shadedColorLabels[4],
                            value: 4,
                            values: {
                                [this.mostUsedLabel]: [
                                    // null,
                                    this.fullColorLabels[1],
                                ],
                                [this.othersLabel]: [
                                    {
                                        label: this.fullColorLabels[2],
                                        value: 2,
                                    },
                                    {
                                        label: this.fullColorLabels[3],
                                        value: 3,
                                    },
                                    {
                                        label: this.fullColorLabels[4],
                                        value: 4,
                                    },
                                    {
                                        label: this.fullColorLabels[6],
                                        value: 6,
                                    },
                                    {
                                        label: this.fullColorLabels[7],
                                        value: 7,
                                    },
                                    {
                                        label: this.fullColorLabels[8],
                                        value: 8,
                                    },
                                    {
                                        label: this.fullColorLabels[9],
                                        value: 9,
                                    },
                                    {
                                        label: this.fullColorLabels[10],
                                        value: 10,
                                    },
                                    {
                                        label: this.fullColorLabels[11],
                                        value: 11,
                                    },
                                    {
                                        label: this.fullColorLabels[12],
                                        value: 12,
                                    },
                                    {
                                        label: this.fullColorLabels[13],
                                        value: 13,
                                    },
                                    {
                                        label: this.fullColorLabels[14],
                                        value: 14,
                                    },
                                    {
                                        label: this.fullColorLabels[15],
                                        value: 15,
                                    },
                                    {
                                        label: this.fullColorLabels[16],
                                        value: 16,
                                    },
                                    {
                                        label: this.fullColorLabels[17],
                                        value: 17,
                                    },
                                    {
                                        label: this.fullColorLabels[18],
                                        value: 18,
                                    },
                                    {
                                        label: this.fullColorLabels[19],
                                        value: 19,
                                    },
                                    {
                                        label: this.fullColorLabels[38],
                                        value: 38,
                                    },
                                    {
                                        label: this.fullColorLabels[39],
                                        value: 39,
                                    },
                                    {
                                        label: this.fullColorLabels[23],
                                        value: 23,
                                    },
                                    {
                                        label: this.fullColorLabels[24],
                                        value: 24,
                                    },
                                    {
                                        label: this.fullColorLabels[25],
                                        value: 25,
                                    },
                                    {
                                        label: this.fullColorLabels[26],
                                        value: 26,
                                    },
                                    {
                                        label: this.fullColorLabels[27],
                                        value: 27,
                                    },
                                    {
                                        label: this.fullColorLabels[28],
                                        value: 28,
                                    },
                                    {
                                        label: this.fullColorLabels[29],
                                        value: 29,
                                    },
                                    {
                                        label: this.fullColorLabels[30],
                                        value: 30,
                                    },
                                    {
                                        label: this.fullColorLabels[31],
                                        value: 31,
                                    },
                                    {
                                        label: this.fullColorLabels[32],
                                        value: 32,
                                    },
                                    {
                                        label: this.fullColorLabels[33],
                                        value: 33,
                                    },
                                    {
                                        label: this.fullColorLabels[34],
                                        value: 34,
                                    },
                                    {
                                        label: this.fullColorLabels[36],
                                        value: 36,
                                    },
                                    {
                                        label: this.fullColorLabels[37],
                                        value: 37,
                                    },
                                ],
                            }
                        },
                        {
                            label: this.fullColorLabels[7],
                            value: 7,
                            values: {
                                [this.mostUsedLabel]: [
                                    // 's hnědými znaky (seal point)',
                                    {
                                        label: this.fullColorLabels[1],
                                        value: 1,
                                    },
                                    {
                                        label: this.fullColorLabels[24],
                                        value: 24,
                                    },
                                    {
                                        label: this.fullColorLabels[25],
                                        value: 25,
                                    },
                                    {
                                        label: this.fullColorLabels[2],
                                        value: 2,
                                    },
                                    {
                                        label: this.fullColorLabels[28],
                                        value: 28,
                                    },
                                ],
                                [this.othersLabel]: [
                                    {
                                        label: this.fullColorLabels[3],
                                        value: 3,
                                    },
                                    {
                                        label: this.fullColorLabels[4],
                                        value: 4,
                                    },
                                    {
                                        label: this.fullColorLabels[6],
                                        value: 6,
                                    },
                                    {
                                        label: this.fullColorLabels[7],
                                        value: 7,
                                    },
                                    {
                                        label: this.fullColorLabels[8],
                                        value: 8,
                                    },
                                    {
                                        label: this.fullColorLabels[9],
                                        value: 9,
                                    },
                                    {
                                        label: this.fullColorLabels[10],
                                        value: 10,
                                    },
                                    {
                                        label: this.fullColorLabels[11],
                                        value: 11,
                                    },
                                    {
                                        label: this.fullColorLabels[12],
                                        value: 12,
                                    },
                                    {
                                        label: this.fullColorLabels[13],
                                        value: 13,
                                    },
                                    {
                                        label: this.fullColorLabels[14],
                                        value: 14,
                                    },
                                    {
                                        label: this.fullColorLabels[15],
                                        value: 15,
                                    },
                                    {
                                        label: this.fullColorLabels[16],
                                        value: 16,
                                    },
                                    {
                                        label: this.fullColorLabels[17],
                                        value: 17,
                                    },
                                    {
                                        label: this.fullColorLabels[18],
                                        value: 18,
                                    },
                                    {
                                        label: this.fullColorLabels[19],
                                        value: 19,
                                    },
                                    {
                                        label: this.fullColorLabels[38],
                                        value: 38,
                                    },
                                    {
                                        label: this.fullColorLabels[39],
                                        value: 39,
                                    },
                                    {
                                        label: this.fullColorLabels[23],
                                        value: 23,
                                    },
                                    {
                                        label: this.fullColorLabels[26],
                                        value: 26,
                                    },
                                    {
                                        label: this.fullColorLabels[27],
                                        value: 27,
                                    },
                                    {
                                        label: this.fullColorLabels[29],
                                        value: 29,
                                    },
                                    {
                                        label: this.fullColorLabels[30],
                                        value: 30,
                                    },
                                    {
                                        label: this.fullColorLabels[31],
                                        value: 31,
                                    },
                                    {
                                        label: this.fullColorLabels[32],
                                        value: 32,
                                    },
                                    {
                                        label: this.fullColorLabels[33],
                                        value: 33,
                                    },
                                    {
                                        label: this.fullColorLabels[34],
                                        value: 34,
                                    },
                                    {
                                        label: this.fullColorLabels[36],
                                        value: 36,
                                    },
                                    {
                                        label: this.fullColorLabels[37],
                                        value: 37,
                                    },
                                ],
                            },
                        },
                        {
                            label: this.shadedColorLabels[6],
                            value: 6,
                            values: {
                                [this.mostUsedLabel]: [
                                    // null,
                                    {
                                        label: this.fullColorLabels[1],
                                        value: 1,
                                    },
                                ],
                                [this.othersLabel]: [
                                    {
                                        label: this.fullColorLabels[3],
                                        value: 3,
                                    },
                                    {
                                        label: this.fullColorLabels[4],
                                        value: 4,
                                    },
                                    {
                                        label: this.fullColorLabels[6],
                                        value: 6,
                                    },
                                    {
                                        label: this.fullColorLabels[7],
                                        value: 7,
                                    },
                                    {
                                        label: this.fullColorLabels[8],
                                        value: 8,
                                    },
                                    {
                                        label: this.fullColorLabels[9],
                                        value: 9,
                                    },
                                    {
                                        label: this.fullColorLabels[10],
                                        value: 10,
                                    },
                                    {
                                        label: this.fullColorLabels[11],
                                        value: 11,
                                    },
                                    {
                                        label: this.fullColorLabels[12],
                                        value: 12,
                                    },
                                    {
                                        label: this.fullColorLabels[13],
                                        value: 13,
                                    },
                                    {
                                        label: this.fullColorLabels[14],
                                        value: 14,
                                    },
                                    {
                                        label: this.fullColorLabels[15],
                                        value: 15,
                                    },
                                    {
                                        label: this.fullColorLabels[16],
                                        value: 16,
                                    },
                                    {
                                        label: this.fullColorLabels[17],
                                        value: 17,
                                    },
                                    {
                                        label: this.fullColorLabels[18],
                                        value: 18,
                                    },
                                    {
                                        label: this.fullColorLabels[19],
                                        value: 19,
                                    },
                                    {
                                        label: this.fullColorLabels[38],
                                        value: 38,
                                    },
                                    {
                                        label: this.fullColorLabels[39],
                                        value: 39,
                                    },
                                    {
                                        label: this.fullColorLabels[23],
                                        value: 23,
                                    },
                                    {
                                        label: this.fullColorLabels[26],
                                        value: 26,
                                    },
                                    {
                                        label: this.fullColorLabels[27],
                                        value: 27,
                                    },
                                    {
                                        label: this.fullColorLabels[29],
                                        value: 29,
                                    },
                                    {
                                        label: this.fullColorLabels[30],
                                        value: 30,
                                    },
                                    {
                                        label: this.fullColorLabels[31],
                                        value: 31,
                                    },
                                    {
                                        label: this.fullColorLabels[32],
                                        value: 32,
                                    },
                                    {
                                        label: this.fullColorLabels[33],
                                        value: 33,
                                    },
                                    {
                                        label: this.fullColorLabels[34],
                                        value: 34,
                                    },
                                    {
                                        label: this.fullColorLabels[36],
                                        value: 36,
                                    },
                                    {
                                        label: this.fullColorLabels[37],
                                        value: 37,
                                    },
                                ],
                            }
                        },
                        {
                            label: this.shadedColorLabels[7],
                            value: 7,
                        },
                        {
                            label: this.shadedColorLabels[8],
                            value: 8,
                            values: {

                                [this.mostUsedLabel]: [
                                    // null,
                                    {
                                        label: this.fullColorLabels[1],
                                        value: 1,
                                    },
                                    {
                                        label: this.fullColorLabels[24],
                                        value: 24,
                                    },
                                    {
                                        label: this.fullColorLabels[25],
                                        value: 25,
                                    },
                                ],
                                [this.othersLabel]: [
                                    {
                                        label: this.fullColorLabels[3],
                                        value: 3,
                                    },
                                    {
                                        label: this.fullColorLabels[4],
                                        value: 4,
                                    },
                                    {
                                        label: this.fullColorLabels[6],
                                        value: 6,
                                    },
                                    {
                                        label: this.fullColorLabels[7],
                                        value: 7,
                                    },
                                    {
                                        label: this.fullColorLabels[8],
                                        value: 8,
                                    },
                                    {
                                        label: this.fullColorLabels[9],
                                        value: 9,
                                    },
                                    {
                                        label: this.fullColorLabels[10],
                                        value: 10,
                                    },
                                    {
                                        label: this.fullColorLabels[11],
                                        value: 11,
                                    },
                                    {
                                        label: this.fullColorLabels[12],
                                        value: 12,
                                    },
                                    {
                                        label: this.fullColorLabels[13],
                                        value: 13,
                                    },
                                    {
                                        label: this.fullColorLabels[14],
                                        value: 14,
                                    },
                                    {
                                        label: this.fullColorLabels[15],
                                        value: 15,
                                    },
                                    {
                                        label: this.fullColorLabels[16],
                                        value: 16,
                                    },
                                    {
                                        label: this.fullColorLabels[17],
                                        value: 17,
                                    },
                                    {
                                        label: this.fullColorLabels[18],
                                        value: 18,
                                    },
                                    {
                                        label: this.fullColorLabels[19],
                                        value: 19,
                                    },
                                    {
                                        label: this.fullColorLabels[38],
                                        value: 38,
                                    },
                                    {
                                        label: this.fullColorLabels[39],
                                        value: 39,
                                    },
                                    {
                                        label: this.fullColorLabels[23],
                                        value: 23,
                                    },
                                    {
                                        label: this.fullColorLabels[26],
                                        value: 26,
                                    },
                                    {
                                        label: this.fullColorLabels[27],
                                        value: 27,
                                    },
                                    {
                                        label: this.fullColorLabels[29],
                                        value: 29,
                                    },
                                    {
                                        label: this.fullColorLabels[30],
                                        value: 30,
                                    },
                                    {
                                        label: this.fullColorLabels[31],
                                        value: 31,
                                    },
                                    {
                                        label: this.fullColorLabels[32],
                                        value: 32,
                                    },
                                    {
                                        label: this.fullColorLabels[33],
                                        value: 33,
                                    },
                                    {
                                        label: this.fullColorLabels[34],
                                        value: 34,
                                    },
                                    {
                                        label: this.fullColorLabels[36],
                                        value: 36,
                                    },
                                    {
                                        label: this.fullColorLabels[37],
                                        value: 37,
                                    },
                                ],
                            }
                        },
                        {
                            label: this.shadedColorLabels[9],
                            value: 9,
                        },
                        {
                            label: this.shadedColorLabels[10],
                            value: 10,
                        },
                        {
                            label: this.shadedColorLabels[11],
                            value: 11,
                        },
                    ],
                },
                {
                    label: this.fullColorLabel,
                    value: 'full',
                    values:
                        [
                            {
                                label: this.fullColorLabels[1],
                                value: 1,
                            },
                            {
                                label: this.fullColorLabels[2],
                                value: 2,
                            },
                            {
                                label: this.fullColorLabels[3],
                                value: 3,
                            },
                            {
                                label: this.fullColorLabels[4],
                                value: 4,
                                values: [
                                    {
                                        label: this.minkColorLabels[0],
                                        value: 0,
                                    },
                                    {
                                        label: this.minkColorLabels[1],
                                        value: 1,
                                    },
                                ]
                            },
                            {
                                label: this.fullColorLabels[5],
                                value: 5,
                            },
                            {
                                label: this.fullColorLabels[6],
                                value: 6,
                            },
                            {
                                label: this.fullColorLabels[7],
                                value: 7,
                            },
                            {
                                label: this.fullColorLabels[8],
                                value: 8,
                                values: [
                                    {
                                        label: this.minkColorLabels[0],
                                        value: 0,
                                    },
                                    {
                                        label: this.minkColorLabels[1],
                                        value: 1,
                                    },
                                ]
                            },
                            {
                                label: this.fullColorLabels[9],
                                value: 9,
                                values: [
                                    {
                                        label: this.minkColorLabels[0],
                                        value: 0,
                                    },
                                    {
                                        label: this.minkColorLabels[1],
                                        value: 1,
                                    },
                                ]
                            },
                            {
                                label: this.fullColorLabels[10],
                                value: 10,
                                values: [
                                    {
                                        label: this.minkColorLabels[0],
                                        value: 0,
                                    },
                                    {
                                        label: this.minkColorLabels[1],
                                        value: 1,
                                    },
                                ]
                            },
                            {
                                label: this.fullColorLabels[11],
                                value: 11,
                                values: [
                                    {
                                        label: this.minkColorLabels[0],
                                        value: 0,
                                    },
                                    {
                                        label: this.minkColorLabels[1],
                                        value: 1,
                                    },
                                ]
                            },
                            {
                                label: this.fullColorLabels[12],
                                value: 12,
                            },
                            {
                                label: this.fullColorLabels[13],
                                value: 13,
                            },
                            {
                                label: this.fullColorLabels[14],
                                value: 14,
                            },
                            {
                                label: this.fullColorLabels[15],
                                value: 15,
                                values: [
                                    {
                                        label: this.minkColorLabels[0],
                                        value: 0,
                                    },
                                    {
                                        label: this.minkColorLabels[1],
                                        value: 1,
                                    },
                                ]
                            },
                            {
                                label: this.fullColorLabels[16],
                                value: 16,
                            },
                            {
                                label: this.fullColorLabels[17],
                                value: 17,
                            },
                            {
                                label: this.fullColorLabels[18],
                                value: 18,
                            },
                            {
                                label: this.fullColorLabels[19],
                                value: 19,
                                values: [
                                    {
                                        label: this.minkColorLabels[0],
                                        value: 0,
                                    },
                                    {
                                        label: this.minkColorLabels[1],
                                        value: 1,
                                    },
                                ]
                            },
                            {
                                label: this.fullColorLabels[20],
                                value: 20,
                                values: [
                                    {
                                        label: this.minkColorLabels[0],
                                        value: 0,
                                    },
                                    {
                                        label: this.minkColorLabels[1],
                                        value: 1,
                                    },
                                ]
                            },
                            {
                                label: this.fullColorLabels[38],
                                value: 38,
                            },
                            {
                                label: this.fullColorLabels[39],
                                value: 39,
                            },
                            {
                                label: this.fullColorLabels[23],
                                value: 23,
                            },
                            {
                                label: this.fullColorLabels[24],
                                value: 24,
                            },
                            {
                                label: this.fullColorLabels[25],
                                value: 25,
                            },
                            {
                                label: this.fullColorLabels[26],
                                value: 26,
                                values: [
                                    {
                                        label: this.minkColorLabels[0],
                                        value: 0,
                                    },
                                    {
                                        label: this.minkColorLabels[1],
                                        value: 1,
                                    },
                                ]
                            },
                            {
                                label: this.fullColorLabels[27],
                                value: 27,
                                values: [
                                    {
                                        label: this.minkColorLabels[0],
                                        value: 0,
                                    },
                                    {
                                        label: this.minkColorLabels[1],
                                        value: 1,
                                    },
                                ]
                            },
                            {
                                label: this.fullColorLabels[28],
                                value: 28,
                            },
                            {
                                label: this.fullColorLabels[29],
                                value: 29,
                            },
                            {
                                label: this.fullColorLabels[30],
                                value: 30,
                                values: [
                                    {
                                        label: this.minkColorLabels[0],
                                        value: 0,
                                    },
                                    {
                                        label: this.minkColorLabels[1],
                                        value: 1,
                                    },
                                ]
                            },
                            {
                                label: this.fullColorLabels[31],
                                value: 31,
                                values: [
                                    {
                                        label: this.minkColorLabels[0],
                                        value: 0,
                                    },
                                    {
                                        label: this.minkColorLabels[1],
                                        value: 1,
                                    },
                                ]
                            },
                            {
                                label: this.fullColorLabels[32],
                                value: 32,
                            },
                            {
                                label: this.fullColorLabels[33],
                                value: 33,
                            },
                            {
                                label: this.fullColorLabels[34],
                                value: 34,
                            },
                            {
                                label: this.fullColorLabels[35],
                                value: 35,
                                values: [
                                    {
                                        label: this.minkColorLabels[0],
                                        value: 0,
                                    },
                                    {
                                        label: this.minkColorLabels[1],
                                        value: 1,
                                    },
                                ]
                            },
                            {
                                label: this.fullColorLabels[36],
                                value: 36,
                                values: [
                                    {
                                        label: this.minkColorLabels[0],
                                        value: 0,
                                    },
                                    {
                                        label: this.minkColorLabels[1],
                                        value: 1,
                                    },
                                ]
                            },
                            {
                                label: this.fullColorLabels[37],
                                value: 37,
                            },
                        ],
                }
            ]
        }
    },
}
</script>
